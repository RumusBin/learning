<?php

namespace Rumus\Http\Controllers;

class FileManagerController
{
    private array $data;

    public function index(): void
    {
        $pathToPublic = '/var/www/html/public/';
        $result = $this->iterator($pathToPublic);
//        echo '<pre>';
//        var_dump($result);
//        echo '</pre>';
//        die;
        $tree = $this->treeHtmlView($result);

        $title = 'File manager tree';
        include_once __DIR__ . '/../../View/Filemanger/index.phtml';
    }

    private function iterator(string $path): array
    {
        $result = [];
        $iterator = new \DirectoryIterator($path);
        foreach ($iterator as $key => $fileInfo) {
            if ($fileInfo->isDir() && !$fileInfo->isDot()) {
                $result['dirs'][] = [
                        'dir_info' => ['dir_name' => $fileInfo->getFilename(), 'dir_data' => $fileInfo],
                        'children' => $this->iterator($fileInfo->getPathname())
                    ];
                // recursion goes here.
            }
            if ($fileInfo->isFile()) {
                $result['files'][] = [$fileInfo->getFilename() => $fileInfo];
            }
        }
        return $result;
    }

    private function treeHtmlView(array $treeData, ?bool $first = true): string
    {
        $result = '';

        foreach ($treeData as $type => $dataInfo) {
            if (!empty($dataInfo) && $type === 'files') {
                $result .= '<ul class="nested"><li><span>Files</span><ul>';
                foreach ($dataInfo as $item) {
                    foreach ($item as $fileName => $fileData) {
                        $result .= '<li>' . $fileName . '</li>';
                    }
                }
                $result .= '</ul></li></ul>';
            }
            if (!empty($dataInfo) && $type === 'dirs') {
                $result .= '<ul><li><span>Directories</span><ul>';
                foreach ($dataInfo as $item) {
                    foreach ($item as $dataType => $dirData) {
                        if ($dataType === 'dir_info') {
                            $result .= '<li>' . $dirData['dir_name'] . '</li>';
                        }
                        if ($dataType === 'children') {
                            $result .= '<li><span>Children</span>' . $this->treeHtmlView($dirData, false) . '</li>';
                        }
                    }
                }
                $result .= '</ul></li></ul>';
            }
        }

        return $result;
    }
}
