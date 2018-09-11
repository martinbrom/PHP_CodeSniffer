<?php

namespace PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

/**
 * Enforces usage of array assignment as an operator
 * Example:
 * 		Wrong: 		$array[] = $item
 * 		Correct: 	$array []= $item
 *
 * @package PHP_CodeSniffer\Standards\Squiz\Sniffs\WhiteSpace
 * @author Martin Brom
 */
class ArrayAssignmentSpacingSniff implements Sniff
{

	/**
	 * Returns an array of tokens this test wants to listen for.
	 *
	 * @return array
	 */
	public function register()
	{
		return [
			T_OPEN_SQUARE_BRACKET => T_OPEN_SQUARE_BRACKET
		];

	}//end register()

	/**
	 * Processes this test, when one of its tokens is encountered.
	 *
	 * @param \PHP_CodeSniffer\Files\File $phpcsFile The file being scanned.
	 * @param int                         $stackPtr  The position of the current token in the
	 *                                               stack passed in $tokens.
	 *
	 * @return void
	 */
	public function process(File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		if (isset($tokens[$stackPtr + 1], $tokens[$stackPtr + 2])
			&& $tokens[$stackPtr + 1]['code'] === T_CLOSE_SQUARE_BRACKET
			&& $tokens[$stackPtr + 2]['code'] === T_WHITESPACE
		) {
			$error = 'Array assignment operator must not be followed by whitespace';
			$fix = $phpcsFile->addFixableError($error, $stackPtr, 'WhiteSpaceAfter');
			if ($fix === TRUE) {
				$phpcsFile->fixer->addContentBefore($stackPtr, ' ');
				$phpcsFile->fixer->replaceToken($stackPtr+2, '');
			}
		}

		if (isset($tokens[$stackPtr - 1], $tokens[$stackPtr + 1], $tokens[$stackPtr + 2])
			&& $tokens[$stackPtr - 1]['code'] !== T_WHITESPACE
			&& $tokens[$stackPtr + 1]['code'] === T_CLOSE_SQUARE_BRACKET
			&& $tokens[$stackPtr + 2]['code'] === T_EQUAL
		) {
			$error = 'Array assignment operator must be preceded by whitespace';
			$fix = $phpcsFile->addFixableError($error, $stackPtr, 'WhiteSpaceBefore');
			if ($fix === TRUE) {
				$phpcsFile->fixer->addContentBefore($stackPtr, ' ');
			}
		}
	}//end process()

}//end class
