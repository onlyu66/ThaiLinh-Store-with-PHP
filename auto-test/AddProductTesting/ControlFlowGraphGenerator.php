<?php
namespace ThaiLinhStore\AddProductTesting;

class ControlFlowGraphGenerator {
    private $nodes = [];
    private $edges = [];

    public function addNode(string $id, string $label) {
        $this->nodes[$id] = $label;
    }

    public function addEdge(string $from, string $to, string $label = '') {
        $this->edges[] = [
            'from' => $from,
            'to' => $to,
            'label' => $label
        ];
    }

    public function renderGraph(string $filename = 'flow_graph.png'): string {
        // Tạo thư mục lưu trữ nếu chưa tồn tại
        $outputDir = __DIR__ . '/../../graphs';
        if (!file_exists($outputDir)) {
            mkdir($outputDir, 0777, true);
        }

        // Đường dẫn file DOT và PNG
        $dotFile = $outputDir . '/flow_graph.dot';
        $pngFile = $outputDir . '/' . $filename;

        // Tạo nội dung DOT
        $dotContent = $this->generateDotContent();

        // Lưu nội dung DOT
        file_put_contents($dotFile, $dotContent);

        // Sinh ảnh
        $this->generateGraphvizImage($dotFile, $pngFile);

        return $pngFile;
    }

    private function generateDotContent(): string {
        $dot = "digraph ProductAddFlow {\n";
        $dot .= "    // Định nghĩa kiểu node\n";
        $dot .= "    node [style=filled, color=lightblue];\n";
        $dot .= "    rankdir=TB;\n\n";

        // Thêm các node
        foreach ($this->nodes as $id => $label) {
            $dot .= "    $id [label=\"$label\"];\n";
        }

        $dot .= "\n    // Các cạnh\n";
        // Thêm các cạnh
        foreach ($this->edges as $edge) {
            $label = $edge['label'] ? " [label=\"{$edge['label']}\"]" : '';
            $dot .= "    {$edge['from']} -> {$edge['to']}$label;\n";
        }

        $dot .= "}\n";

        return $dot;
    }

    private function generateGraphvizImage(string $dotFile, string $pngFile) {
        // Kiểm tra Graphviz đã cài đặt
        $graphvizPath = $this->findGraphvizPath();
        
        if (!$graphvizPath) {
            throw new \Exception("Graphviz không được cài đặt");
        }

        // Lệnh sinh ảnh
        $command = sprintf(
            '%s -Tpng %s -o %s',
            escapeshellarg($graphvizPath),
            escapeshellarg($dotFile),
            escapeshellarg($pngFile)
        );

        // Thực thi lệnh
        exec($command, $output, $returnVar);

        if ($returnVar !== 0) {
            throw new \Exception("Lỗi khi tạo ảnh Graphviz: " . implode("\n", $output));
        }
    }

    private function findGraphvizPath(): ?string {
        // Các vị trí có thể của Graphviz
        $possiblePaths = [
            // Windows
            'C:\Program Files\Graphviz\bin\dot.exe',
            'C:\Program Files (x86)\Graphviz\bin\dot.exe',
            
            // Linux
            '/usr/bin/dot',
            '/usr/local/bin/dot',
            
            // Mac
            '/opt/homebrew/bin/dot',
            '/usr/local/opt/graphviz/bin/dot'
        ];

        // Thử từng đường dẫn
        foreach ($possiblePaths as $path) {
            if (file_exists($path) && is_executable($path)) {
                return $path;
            }
        }

        // Thử command
        exec('which dot', $output, $returnVar);
        if ($returnVar === 0 && !empty($output)) {
            return trim($output[0]);
        }

        return null;
    }
}