<?php
class MyStandard_Sniffs_Files_DissalowLongMethodsSniff implements PHP_CodeSniffer_Sniff
{
    public $limit = 120;

    public function register()
    {
        return array(T_OPEN_TAG);

    }

    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $tokens = $phpcsFile->getTokens();
        for ($i = 1; $i < $phpcsFile->numTokens; $i++) {
            if ($tokens[$i]['column'] === 1) {
                $this->checkLineLength($phpcsFile, $tokens, $i);
            }
        }
    }
    protected function checkLineLength(PHP_CodeSniffer_File $phpcsFile, $tokens, $stackPtr)
    {
        $stackPtr--;

        if ($tokens[$stackPtr]['column'] === 1
            && $tokens[$stackPtr]['length'] === 0
        ) {
            return;
        }

        if ($tokens[$stackPtr]['column'] !== 1
            && $tokens[$stackPtr]['content'] === $phpcsFile->eolChar
        ) {
            $stackPtr--;
        }

        $lineLength = ($tokens[$stackPtr]['column'] + $tokens[$stackPtr]['length'] - 1);

        if ($lineLength > $this->limit) {
            $data = array(
                     $this->limit,
                     $lineLength,
                    );

            $warning = 'Eilutė viršija %s simbolių; Sudaro %s simbolių';
            $phpcsFile->addWarning($warning, $stackPtr, 'TooLong', $data);
        }

    }
}
?>

