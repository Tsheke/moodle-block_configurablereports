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
 * Configurable Reports
 * A Moodle block for creating customizable reports
 *
 * @package  block_configurablereports
 * @author   Juan leyva <http://www.twitter.com/jleyvadelgado>
 * @date     2009
 */

defined('MOODLE_INTERNAL') || die;

require_once($CFG->libdir . '/formslib.php');

/**
 * Class usersincurrentcourse_form
 *
 * @package  block_configurablereports
 * @author   Juan leyva <http://www.twitter.com/jleyvadelgado>
 * @date     2009
 */
class usersincurrentcourse_form extends moodleform {

    /**
     * Form definition
     */
    public function definition(): void {
        global $DB;

        $mform =& $this->_form;

        $mform->addElement('header', 'crformheader', get_string('coursefield', 'block_configurable_reports'), '');

        $roles = $DB->get_records('role');
        $userroles = [];
        foreach ($roles as $r) {
            $userroles[$r->id] = $r->shortname;
        }

        $mform->addElement('select', 'roles', get_string('roles'), $userroles, ['multiple' => 'multiple']);

        // Buttons.
        $this->add_action_buttons(true, get_string('add'));
    }

}
