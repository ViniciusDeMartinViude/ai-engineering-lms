<?php
// SPDX-License-Identifier: GPL-3.0-or-later
defined('MOODLE_INTERNAL') || die();

$THEME->name = 'aieng';
$THEME->parents = ['boost'];
$THEME->sheets = [];
$THEME->rendererfactory = 'theme_overridden_renderer_factory';
$THEME->iconsystem = \core\output\icon_system::FONTAWESOME;
$THEME->haseditswitch = true;
$THEME->usescourseindex = true;
$THEME->scss = function ($theme) {
    global $CFG;
    $preset = $CFG->dirroot . '/theme/boost/scss/preset/default.scss';
    return '$primary: #1556a2;' . "\n" . file_get_contents($preset)
        . "\n" . file_get_contents(__DIR__ . '/scss/studio.scss');
};
