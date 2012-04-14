<?php

class simplenotes_add_form extends moodleform {

    function definition() {

        $mform =& $this->_form; // Don't forget the underscore! 

        // note title
        $attrib_title = array('size' => '40');
        $mform->addElement('text', 'title', get_string('add_note_title', 'block_simplenotes'), $attrib_title);
        $mform->addRule('title', null, 'maxlength', 50);
        $mform->setType('title', PARAM_NOTAGS); // no tags but 'htmlentities' the rest

        // note itself
        $attrib_note = array('wrap' => 'virtual', 'rows' => 5, 'cols' => 40);
        $mform->addElement('textarea', 'note', get_string('add_note_text', 'block_simplenotes'), $attrib_note);
        $mform->addRule('note', null, 'required');
        $mform->applyFilter('note', 'trim');
        //$mform->setType('note', PARAM_NOTAGS);
        $mform->setType('note', PARAM_RAW); // keep tags but 'htmlentities' them!

        // priority // wanted a dop-down menu but this will have to do
        // no idea what can or should go in here:
        $radioarray = array();
        $radioarray[] = &$mform->createElement('radio', 'priority', null, get_string('pri1', 'block_simplenotes'), 1);
        $radioarray[] = &$mform->createElement('radio', 'priority', null, get_string('pri2', 'block_simplenotes'), 2);
        $radioarray[] = &$mform->createElement('radio', 'priority', null, get_string('pri3', 'block_simplenotes'), 3);
        $radioarray[] = &$mform->createElement('radio', 'priority', null, get_string('pri4', 'block_simplenotes'), 4);
        $mform->addGroup($radioarray, 'priority', get_string('add_note_pri', 'block_simplenotes'), ' ', false);
        $mform->addRule('priority', null, 'required');
        $mform->setType('priority', PARAM_INT);
        $mform->setDefault('priority', 3);

        // course id, to redirect to when done. default is eight 9's so we KNOW when it goes wrong.
        //$mform->addElement('hidden', 'redir', required_param('redir', 99999999, PARAM_INT));
        $mform->addElement('hidden', 'redir', $redir);

        // buttons
        $buttonarray = array();
        $buttonarray[] = &$mform->createElement('submit', 'submitbutton', get_string('savechanges'));
        $buttonarray[] = &$mform->createElement('reset', 'resetbutton', get_string('revert'));
        $buttonarray[] = &$mform->createElement('cancel');
        $mform->addGroup($buttonarray, 'buttonar', '', array(' '), false);

    } // Close the function
} // Close the class