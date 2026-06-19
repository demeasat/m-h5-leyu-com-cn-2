<?php

function renderLinkCard(string $url, string $keywords, string $title = ''): string
{
    $safeUrl = htmlspecialchars($url, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $safeKeywords = htmlspecialchars($keywords, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $safeTitle = $title !== '' ? htmlspecialchars($title, ENT_QUOTES | ENT_HTML5, 'UTF-8') : $safeKeywords;

    $cardHtml = '<div class="link-card">' . "\n";
    $cardHtml .= '    <a href="' . $safeUrl . '" target="_blank" rel="noopener noreferrer">' . "\n";
    $cardHtml .= '        <div class="link-card-content">' . "\n";
    $cardHtml .= '            <h3 class="link-card-title">' . $safeTitle . '</h3>' . "\n";
    $cardHtml .= '            <p class="link-card-description">' . $safeKeywords . '</p>' . "\n";
    $cardHtml .= '            <span class="link-card-url">' . $safeUrl . '</span>' . "\n";
    $cardHtml .= '        </div>' . "\n";
    $cardHtml .= '    </a>' . "\n";
    $cardHtml .= '</div>' . "\n";

    return $cardHtml;
}

function buildLinkCardFromConfig(array $config): string
{
    $defaultUrl = 'https://m-h5-leyu.com.cn';
    $defaultKeywords = '乐鱼体育';

    $url = isset($config['url']) && is_string($config['url']) ? $config['url'] : $defaultUrl;
    $keywords = isset($config['keywords']) && is_string($config['keywords']) ? $config['keywords'] : $defaultKeywords;
    $title = isset($config['title']) && is_string($config['title']) ? $config['title'] : '';

    return renderLinkCard($url, $keywords, $title);
}

function generateLinkCardHtml(array $dataSet): string
{
    $output = '';

    foreach ($dataSet as $index => $item) {
        if (!is_array($item)) {
            continue;
        }

        $url = $item['url'] ?? 'https://m-h5-leyu.com.cn';
        $keywords = $item['keywords'] ?? '乐鱼体育';
        $title = $item['title'] ?? '';

        $output .= '<div class="link-card-wrapper" data-index="' . $index . '">' . "\n";
        $output .= renderLinkCard($url, $keywords, $title);
        $output .= '</div>' . "\n";
    }

    return $output;
}

$sampleConfig = [
    'url' => 'https://m-h5-leyu.com.cn',
    'keywords' => '乐鱼体育',
    'title' => '乐鱼体育官方平台',
];

$sampleHtml = buildLinkCardFromConfig($sampleConfig);

$multipleCards = [
    ['url' => 'https://m-h5-leyu.com.cn', 'keywords' => '乐鱼体育', 'title' => '首页'],
    ['url' => 'https://m-h5-leyu.com.cn/news', 'keywords' => '乐鱼体育新闻', 'title' => '新闻中心'],
    ['url' => 'https://m-h5-leyu.com.cn/contact', 'keywords' => '乐鱼体育客服', 'title' => '联系我们'],
];

$multipleHtml = generateLinkCardHtml($multipleCards);

// 示例输出
echo $sampleHtml;
echo "\n---\n";
echo $multipleHtml;