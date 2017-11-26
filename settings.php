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
 * Image filter admin settings
 *
 * @package atto_imageaccessability
 * @copyright 2017 SysBind, Israel.
 * @license http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

if ($ADMIN->fulltree) {
    $config = get_config('atto_imageaccessability');
    $settings->add(new admin_setting_heading('atto_imageaccessability',
        get_string('requirement', 'atto_imageaccessability'), get_string('requirementdesc', 'atto_imageaccessability')));
    $settings->add(new admin_setting_configtextarea('atto_imageaccessability/privatekey',
        get_string('privatekey', 'atto_imageaccessability'), get_string('privatekeydesc', 'atto_imageaccessability'), '', PARAM_RAW, 100, 35));
    $settings->add(new admin_setting_configtext('atto_imageaccessability/privatekeyid',
        get_string('privatekeyid', 'atto_imageaccessability'), get_string('privatekeyidydesc', 'atto_imageaccessability'), ''));
    $settings->add(new admin_setting_configtext('atto_imageaccessability/client',
        get_string('client', 'atto_imageaccessability'), get_string('clientdec', 'atto_imageaccessability'), ''));
    $settings->add(new admin_setting_configtext('atto_imageaccessability/clientid',
        get_string('clientid', 'atto_imageaccessability'), get_string('clientiddesc', 'atto_imageaccessability'), ''));
    $settings->add(new admin_setting_configtext('atto_imageaccessability/serviceaccount',
        get_string('serviceaccount', 'atto_imageaccessability'), get_string('serviceaccountdesc', 'atto_imageaccessability'), ''));
    $settings->add(new admin_setting_configtext('atto_imageaccessability/minscore',
        get_string('minscore', 'atto_imageaccessability'), get_string('minscoredesc', 'atto_imageaccessability'), 85));
}