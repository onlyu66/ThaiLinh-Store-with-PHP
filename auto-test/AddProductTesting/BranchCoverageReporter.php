<?php
namespace ThaiLinhStore\AddProductTesting;

class BranchCoverageReporter {
    private $totalBranches = [];
    private $executedBranches = [];

    public function addTotalBranch(string $branch) {
        $this->totalBranches[$branch] = false;
    }

    public function markBranchExecuted(string $branch) {
        if (isset($this->totalBranches[$branch])) {
            $this->totalBranches[$branch] = true;
            $this->executedBranches[] = $branch;
        }
    }

    public function generateReport(): string {
        $totalBranchCount = count($this->totalBranches);
        $executedBranchCount = count($this->executedBranches);
        $coveragePercentage = $totalBranchCount > 0 
            ? round(($executedBranchCount / $totalBranchCount) * 100, 2) 
            : 0;

        $report = "Branch Coverage Report:\n";
        $report .= "-------------------\n";
        $report .= "Total Branches: $totalBranchCount\n";
        $report .= "Executed Branches: $executedBranchCount\n";
        $report .= "Coverage Percentage: $coveragePercentage%\n\n";

        $report .= "Executed Branches:\n";
        foreach ($this->executedBranches as $branch) {
            $report .= "- $branch\n";
        }

        $report .= "\nUnexecuted Branches:\n";
        foreach ($this->totalBranches as $branch => $executed) {
            if (!$executed) {
                $report .= "- $branch\n";
            }
        }

        // Lưu báo cáo vào file
        $reportDir = __DIR__ . '/../../reports';
        if (!file_exists($reportDir)) {
            mkdir($reportDir, 0777, true);
        }
        
        $reportFile = $reportDir . '/branch_coverage_' . date('Y-m-d_H-i-s') . '.txt';
        file_put_contents($reportFile, $report);

        return $report;
    }
}