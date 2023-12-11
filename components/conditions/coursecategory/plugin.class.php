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
require_once($CFG->dirroot . '/blocks/configurable_reports/plugin.class.php');

/**
 * Class plugin_coursecategory
 *
 * @package  block_configurablereports
 * @author   Juan leyva <http://www.twitter.com/jleyvadelgado>
 * @date     2009
 */
class plugin_coursecategory extends plugin_base {

    /**
     * Init
     * @return void
     */
    public function init(): void {
        $this->fullname = get_string('coursecategory', 'block_configurable_reports');
        $this->type = 'text';
        $this->form = true;
        $this->reporttypes = ['courses'];
    }

    /**
     * Summary
     *
     * @param object $data
     * @return string
     */
    public function summary(object $data): string {
        global $DB;

        $cat = $DB->get_record('course_categories', ['id' => $data->categoryid]);
        if ($cat) {
            return get_string('category') . ' ' . $cat->name;
        }

        return get_string('category') . ' ' . get_string('top');
    }

    /**
     * Execute
     *
     * @param $data
     * @param $user
     * @param $courseid
     * @return array|int[]|string[]
     */
    public function execute($data, $user, $courseid) {
        global $DB;
        // Data -> Plugin configuration data.

        $courses = $DB->get_records('course', ['category' => $data->categoryid]);
        if ($courses) {
            return array_keys($courses);
        }

        return [];
    }

}
