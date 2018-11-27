<?php

class Filter
{
    /**
     * 格式化标签
     * phpQuery
     * @param string $content
     * @return string
     */
    public function format($content) {
        $content = str_replace(array("\r", "\n", "\t"), '', $content);
        $content = preg_replace('/\s{6,}/', '', $content);
        $content = preg_replace('/<!--[\s\S]*?-->/', '', $content);
        $content = preg_replace('/<script[\s\S]*?<\/script>/', '', $content);
        $content = preg_replace('/<video[\s\S]*?<\/video>/', '', $content);

        $content = str_replace('div', 'p', $content);
        $content = preg_replace('/<p[\s\S]*?style=\"display:none\"[\s\S]*?<\/p>/', '', $content);
        $content = preg_replace('/(<p)[\s\S]*?(>)/', '$1$2', $content);
        $content = preg_replace('/<p>[\s]*<\/p>/', '', $content);
        $content = preg_replace('/<p>[\s]*<br>[\s]*<\/p>/', '', $content);
        $content = preg_replace('/(<p>\s*)*<p>/', '<p>', $content);
        $content = preg_replace('/(<\/p>\s*)*<\/p>/', '</p>', $content);

        $content = preg_replace('/<(h\d{1})[\s\S]*?>([\s\S]*?)<\/\1>/i', '<p>$2</p>', $content);
        // $content = preg_replace('/(<\/?)h\d{1}[\s\S]*?(>)/i', '$1p$2', $content);
        $content = preg_replace('/<a[\s\S]*?>([\s\S]*?)<\/a>/', '$1', $content);
        $content = preg_replace('/(<img)[\s\S]*?(src="[\s\S]*?")[\s\S]*?(>)/', '$1 $2$3', $content);

        $content = str_replace(array('<strong>', '</strong>'), '', $content);

        return trim($content);
    }

    public function find($matches) {
        // 通常: $matches[0]是完成的匹配
        // $matches[1]是第一个捕获子组的匹配
        // 以此类推
        // var_dump($matches);
        $patterns = [
            '/不得转载/', '/责任编辑[:：]?/',  '/作者[:：]?/',
            '/本文来源[:：]?/', '/原文链接[:：]?/', '/原标题[:：]?/',
            // '/公众号/', '/一点号/', '/微信号/', '/头条号/', '/微信平台/', '/蓝字/',
            '/加威信/', '/加微心/', '/关注我们/', '/关注我/',
        ];
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $matches[1])) {
                return '';
            }
            else if (! trim($matches[1])) {
                return '';
            }
        }
        // return trim($matches[1]);
        return '<p>' .trim($matches[1]) . '</p>';
    }

    public function handle($content) {
        return preg_replace_callback('/<p[\s\S]*?>([\s\S]*?)<\/p>/', array($this, 'find'), $content);
    }

    public function finder($content) {
        $pattern = '/<p[\s\S]*?>([\s\S]*?)<\/p>/';
        return preg_replace_callback($pattern, function ($matches) {
            // 通常: $matches[0]是完成的匹配
            // $matches[1]是第一个捕获子组的匹配
            // 以此类推
            $patterns = [
                '/不得转载/', '/责任编辑[:：]?/',  '/作者[:：]?/',
                '/本文来源[:：]?/', '/原文链接[:：]?/', '/原标题[:：]?/',
                // '/公众号/', '/一点号/', '/微信号/', '/头条号/', '/微信平台/', '/蓝字/',
                '/加威信/', '/加微心/', '/关注我们/', '/关注我/',
            ];
            foreach ($patterns as $pattern) {
                if (preg_match($pattern, $matches[1])) {
                    return '';
                }
                else if (! trim($matches[1])) {
                    return '';
                }
            }
            return '<p>' .trim($matches[1]) . '</p>';
        }, $content);
    }
}