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
 * The invitation_viewed event.
 *
 * @package    enrol_invitation
 * @copyright  2021 Christian Brugger (brugger.chr@gmail.com
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
namespace enrol_invitation\event;
defined('MOODLE_INTERNAL') || die();

class invitation_viewed extends invitation_base {
    protected function init() {
        $this->data['crud'] = 'r'; // c(reate), r(ead), u(pdate), d(elete)
        $this->data['edulevel'] = self::LEVEL_OTHER;
        $this->data['objecttable'] = 'enrol_invitation_invitation_manager';
    }
    
            /**
     * Create this event on a given invitation.
     *
     * @param object $invitation
     * @return \core\event\base
     */
    public static function create_from_invitation($invitation) {
        $event = self::create(self::base_data($invitation));
        $event->set_invitation($invitation);
        return $event;
    }
 
    public static function get_name() {
        return get_string('event_invitation_viewed', 'enrol_invitation');
    }
 
    public function get_description() {
        return "The user with id {$this->userid} viewed invitation " .
	        "for course with id '{$this->other['courseid']}'";
    }
 
    public function get_url() {
		return new \moodle_url('/enrol/invitation/history.php', array('courseid' => $this->other['courseid']));
    }
 
}