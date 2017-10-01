<?php


namespace App\Components;


use Symfony\Component\DomCrawler\Crawler;


class SearchPage
{
    /**
     * @var Crawler
     */
    private $dom;


    public function __construct($html)
    {
        $this->dom = new Crawler($html);
    }


    private function filterElement(Crawler $element, $cssSelector, $callback)
    {
        $result = [];
        $element->filter($cssSelector)->each(function (Crawler $element) use (&$result, $callback) {
            $result[] = $this->escape($callback($element));
        });

        return $result;
    }


    private function filter(string $cssSelector, $callback)
    {
        return $this->filterElement($this->dom, $cssSelector, $callback);
    }


    public function realtyTypes()
    {
        return $this->filter('.tabblock select[name="type"] option', function (Crawler $option) {
            return [
                'id'       => $this->escape($option->attr('value')),
                'title'    => $this->escape($option->text()),
                'isHeader' => !! $option->attr('disabled'),
            ];
        });
    }


    private function escape($data)
    {
        if (is_string($data)) {
            return htmlspecialchars($data);
        }

        if (is_array($data)) {
            foreach ($data as $key => &$value) {
                $value = $this->escape($value);
            }
        }

        return $data;
    }


    public function rooms()
    {
        return $this->filter('#rooms input', function (Crawler $input) {
            return $input->attr('value');
        });
    }


    public function results()
    {
        return $this->filter('.result table tr', function (Crawler $tr) {
            return $this->filterElement($tr, 'td', function (Crawler $td) {
                return $this->escape($td->text());
            });
        });
    }
}
