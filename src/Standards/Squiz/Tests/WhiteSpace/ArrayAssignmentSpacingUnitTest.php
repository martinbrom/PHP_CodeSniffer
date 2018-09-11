<?php
/**
 * Unit test class for the ControlStructureSpacing sniff.
 *
 * @author Martin Brom
 */

namespace PHP_CodeSniffer\Standards\Squiz\Tests\WhiteSpace;

use PHP_CodeSniffer\Tests\Standards\AbstractSniffUnitTest;

class ArrayAssignmentSpacingUnitTest extends AbstractSniffUnitTest
{


	/**
	 * Returns the lines where errors should occur.
	 *
	 * The key of the array should represent the line number and the value
	 * should represent the number of errors that should occur on that line.
	 *
	 * @return array<int, int>
	 */
	public function getErrorList()
	{
		return [
			4 => 1,
			6 => 1,
		];

	}//end getErrorList()


	/**
	 * Returns the lines where warnings should occur.
	 *
	 * The key of the array should represent the line number and the value
	 * should represent the number of warnings that should occur on that line.
	 *
	 * @return array<int, int>
	 */
	public function getWarningList()
	{
		return [];

	}//end getWarningList()


}//end class
