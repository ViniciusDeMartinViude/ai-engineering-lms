<?php
// SPDX-License-Identifier: GPL-3.0-or-later
namespace theme_aieng\output;

defined('MOODLE_INTERNAL') || die();

class core_renderer extends \theme_boost\output\core_renderer {
    private function has_workspace(): bool {
        return isloggedin() && !isguestuser() && in_array($this->page->pagelayout,
            ['standard','admin','coursecategory','course','incourse','frontpage','mydashboard','mycourses','report','mypublic'], true);
    }

    private function link(string $path, string $key, string $icon): array {
        $url = new \moodle_url($path);
        return ['url' => $url->out(false), 'label' => get_string($key, 'theme_aieng'), 'icon' => $icon,
            'active' => $this->page->url->compare($url, URL_MATCH_BASE)];
    }

    private function menu_context(): array {
        $learning = [
            $this->link('/my/', 'dashboard', 'fa-gauge'),
            $this->link('/my/courses.php', 'courses', 'fa-book-open'),
            $this->link('/calendar/view.php', 'calendar', 'fa-calendar-days'),
        ];
        $tools = [$this->link('/user/profile.php', 'profile', 'fa-user')];
        if (has_capability('moodle/category:manage', \context_system::instance()) || is_siteadmin()) {
            $tools[] = $this->link('/course/management.php', 'managecourses', 'fa-folder-open');
        }
        if (is_siteadmin()) {
            $tools[] = $this->link('/admin/search.php', 'settings', 'fa-sliders');
        }
        return ['learning' => $learning, 'tools' => $tools];
    }

    public function standard_top_of_body_html() {
        $html = parent::standard_top_of_body_html();
        return $this->has_workspace() ? $html . $this->render_from_template('theme_aieng/rail', $this->menu_context()) : $html;
    }

    public function full_header() {
        $html = parent::full_header();
        if (!$this->has_workspace()) {
            return $html;
        }
        $html = $this->render_from_template('theme_aieng/mobile', $this->menu_context()) . $html;
        if ($this->page->pagelayout !== 'mydashboard') {
            return $html;
        }
        $cards = [];
        foreach (enrol_get_my_courses('shortname', 'sortorder ASC', 3) as $course) {
            $context = \context_course::instance($course->id);
            $cards[] = ['title' => format_string($course->fullname, true, ['context' => $context, 'escape' => false]),
                'url' => (new \moodle_url('/course/view.php', ['id' => $course->id]))->out(false)];
        }
        return $html . $this->render_from_template('theme_aieng/training', [
            'courses' => $cards, 'catalog' => (new \moodle_url('/course/index.php'))->out(false),
            'calendar' => (new \moodle_url('/calendar/view.php'))->out(false),
        ]);
    }
}
