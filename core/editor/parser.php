<?php
namespace Core\Editor;

class Parser {
    public function convert($editorData) {
        $html = '';

        foreach ($editorData['blocks'] as $block) {
            $html .= $this->convertBlock($block);
        }

        return $html;
    }

    private function convertBlock($block) {
        switch ($block['type']) {
            case 'paragraph':
                return $this->convertParagraph($block['data']);
            case 'header':
                return $this->convertHeader($block['data']);
            case 'list':
                return $this->convertList($block['data']);
            case 'image':
                return $this->convertImage($block['data']);
            case 'simpleImage':
                return $this->convertSimpleImage($block['data']);
            case 'quote':
                return $this->convertQuote($block['data']);
            case 'code':
                return $this->convertCode($block['data']);
            case 'raw':
                return $this->convertRaw($block['data']);
            case 'table':
                return $this->convertTable($block['data']);
            case 'delimiter':
                return $this->convertDelimiter();
            case 'warning':
                return $this->convertWarning($block['data']);
            case 'checklist':
                return $this->convertChecklist($block['data']);
            case 'marker':
                return $this->convertMarker($block['data']);
            case 'inlineCode':
                return $this->convertInlineCode($block['data']);
            case 'linkTool':
                return $this->convertLinkTool($block['data']);
            case 'embed':
                return $this->convertEmbed($block['data']);
            case 'attaches':
                return $this->convertAttaches($block['data']);
            default:
                return $this->convertDefault($block['data']);
        }
    }

    private function convertParagraph($data) {
        return '<p class="mb-3">' . $data['text'] . '</p>';
    }

    private function convertHeader($data) {
        return '<h' . $data['level'] . ' class="mt-4">' . $data['text'] . '</h' . $data['level'] . '>';
    }

    private function convertList($data) {
        $listTag = $data['style'] == 'unordered' ? 'ul' : 'ol';
        $html = '<' . $listTag . ' class="mb-3">';
        foreach ($data['items'] as $item) {
            if (is_array($item)) {
                $html .= '<li>' . $this->convertList(['style' => $data['style'], 'items' => $item['items']]) . '</li>';
            } else {
                $html .= '<li>' . $item . '</li>';
            }
        }
        $html .= '</' . $listTag . '>';
        return $html;
    }

    private function convertImage($data) {
        return '<figure class="figure"><img src="' . htmlspecialchars($data['file']['url']) . '" class="figure-img img-fluid rounded" alt="' . htmlspecialchars($data['caption']) . '"><figcaption class="figure-caption text-center">' . htmlspecialchars($data['caption']) . '</figcaption></figure>';
    }

    private function convertSimpleImage($data) {
        return '<figure class="figure"><img src="' . htmlspecialchars($data['url']) . '" class="figure-img img-fluid rounded" alt="' . htmlspecialchars($data['caption']) . '"><figcaption class="figure-caption text-center">' . htmlspecialchars($data['caption']) . '</figcaption></figure>';
    }

    private function convertQuote($data) {
        return '<blockquote class="blockquote"><p class="mb-0">' . htmlspecialchars($data['text']) . '</p><footer class="blockquote-footer">' . htmlspecialchars($data['caption']) . '</footer></blockquote>';
    }

    private function convertCode($data) {
        return '<pre class="mb-3"><code>' . htmlspecialchars($data['code']) . '</code></pre>';
    }

    private function convertRaw($data) {
        return '<div class="mb-3">' . $data['html'] . '</div>';
    }

    private function convertTable($data) {
        $html = '<table class="table">';
        foreach ($data['content'] as $row) {
            $html .= '<tr>';
            foreach ($row as $cell) {
                $html .= '<td>' . htmlspecialchars($cell) . '</td>';
            }
            $html .= '</tr>';
        }
        $html .= '</table>';
        return $html;
    }

    private function convertDelimiter() {
        return '<hr class="my-4">';
    }

    private function convertWarning($data) {
        return '<div class="alert alert-warning" role="alert"><strong>' . htmlspecialchars($data['title']) . '</strong> ' . htmlspecialchars($data['message']) . '</div>';
    }

    private function convertChecklist($data) {
        $html = '<ul class="list-group mb-3">';
        foreach ($data['items'] as $item) {
            $checked = $item['checked'] ? 'checked' : '';
            $html .= '<li class="list-group-item"><input class="form-check-input me-1" type="checkbox" disabled ' . $checked . '>' . htmlspecialchars($item['text']) . '</li>';
        }
        $html .= '</ul>';
        return $html;
    }

    private function convertMarker($data) {
        return '<mark>' . htmlspecialchars($data['text']) . '</mark>';
    }

    private function convertInlineCode($data) {
        return '<code>' . htmlspecialchars($data['text']) . '</code>';
    }

    private function convertLinkTool($data) {
        return '<a href="' . htmlspecialchars($data['link']) . '>' . htmlspecialchars($data['link']) . '</a>';
    }

    private function convertEmbed($data) {
        return '<div class="embed-responsive embed-responsive-16by9 mb-3"><iframe class="embed-responsive-item" src="' . htmlspecialchars($data['embed']) . '" allowfullscreen></iframe></div>';
    }

    private function convertAttaches($data) {
        return '<div class="mb-3"><a href="' . htmlspecialchars($data['file']['url']) . '" download>' . htmlspecialchars($data['title']) . '</a></div>';
    }

    private function convertDefault($data) {
        return '<div class="mb-3">' . htmlspecialchars($data['text']) . '</div>';
    }
}
?>
