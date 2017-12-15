<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Renders text with the active filters and returns it. Used to create previews of equations
 * using whatever tex filters are enabled.
 *
 * @package    atto_imageaccessability
 * @copyright  2017 SysBind
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace atto_imageaccessability;

use Google\Cloud\Vision\VisionClient;
use Google\Cloud\Translate\TranslateClient;

define('AJAX_SCRIPT', true);

require_once(__DIR__ . '/../../../../../config.php');
require_once($CFG->dirroot . '/vendor/autoload.php');
require_once($CFG->libdir . '/filelib.php');
require_once($CFG->dirroot . '/repository/url/locallib.php');

$imageurl = required_param('image', PARAM_URL);
$contextid = required_param('contextid', PARAM_INT);

list($context, $course, $cm) = get_context_info_array($contextid);
$PAGE->set_url('/lib/editor/atto/plugins/imageaccessability/ajax.php');
$PAGE->set_context($context);

require_login();
require_sesskey();

$path = split_url($imageurl);

// relative path must start with '/'
if (!$path) {
    print_error('invalidargorconf');
}
// extract relative path components
$args = explode('/', substr($path['path'], strpos(ltrim($path['path'], '/'), '.php')));
array_shift($args);
if (count($args) == 0) { // always at least user id
    print_error('invalidarguments');
}

$contextid = (int)array_shift($args);
$component = array_shift($args);
$filearea  = array_shift($args);
$draftid   = (int)array_shift($args);

if ($component !== 'user' or $filearea !== 'draft') {
    send_file_not_found();
}

$context = \context::instance_by_id($contextid);
if ($context->contextlevel != CONTEXT_USER) {
    send_file_not_found();
}

$userid = $context->instanceid;
if ($USER->id != $userid) {
    print_error('invaliduserid');
}


$fs = get_file_storage();

$relativepath = urldecode(implode('/', $args));
$fullpath = "/$context->id/user/draft/$draftid/$relativepath";
if (!$file = $fs->get_file_by_hash(sha1($fullpath)) or $file->get_filename() == '.') {
    // This should not happen.
    debugging('File is not readable.');
    print_error('invalidarguments');
    return;
}
if (!in_array('image', explode('/', $file->get_mimetype()))) {
    print_error('invalidarguments');
    return;
}
$config = get_config('atto_imageaccessability');
$client = $config->client;
$clientid = $config->clientid;
$privatekeyid = $config->privatekeyid;
$privatekey = $config->privatekey;
$serviceaccount = $config->serviceaccount;
$minscore = $config->minscore / 100;
$creditional = [
    'projectId' => $client,
    'keyFile' => [
        'type' => 'service_account',
        'project_id' => $client,
        'private_key_id' => $privatekeyid,
        'private_key' => $privatekey,
        'client_email' => "$serviceaccount@$client.iam.gserviceaccount.com",
        'client_id' => $clientid,
        'auth_uri' => 'https://accounts.google.com/o/oauth2/auth',
        'token_uri' => 'https://accounts.google.com/o/oauth2/token',
        'auth_provider_x509_cert_url' => 'https://www.googleapis.com/oauth2/v1/certs',
        'client_x509_cert_url' => "https://www.googleapis.com/robot/v1/metadata/x509/$serviceaccount%40$client.iam.gserviceaccount.com",
    ],
];
$vision = new VisionClient($creditional);
$translate = new TranslateClient($creditional);
$options[] = 'LABEL_DETECTION';
$image = $vision->image($file->get_content_file_handle(), $options);
$labels = $vision->annotate($image)->labels();
$anotations = array();
$lang = substr(get_string('locale', 'langconfig'),0,2);
foreach ($labels as $label) {
    if ($label->score() >= $minscore) {
        if($lang == 'en'){
            $anotations[] = $label->description();
        } else {
            $anotations[] = $translate->translate($label->description(),
                ['target' => $lang])['text'];
        }
    }
}
echo $OUTPUT->header();
echo implode(',', $anotations);
die();


