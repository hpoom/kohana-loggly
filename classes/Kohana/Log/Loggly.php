<?php defined('SYSPATH') or die('No direct script access.');

/**
 * Kohana Loggly is a Log Writer that sends all log messages to a loggly account.
 *
 * @author	Simon Wood	<hpoomdev@gmail.com>
 */
class Kohana_Log_Loggly extends Log_Writer {
	/**
	 * @var  string  Input key used for logging
	 */
	protected $_inputKey;
	
	/**
	 * Creates a new loggly logger. Checks that the key is in the correct format and length.
	 *
	 *     $writer = new Log_File( $inputKey );
	 *
	 * @param   string  loggly input key
	 * @return  void
	 */
	public function __construct( $inputKey ) {
		// Check key is valid and store it for use in the write method
		if ( !is_string( $inputKey ) || Valid::exact_length( $inputKey, 36 ) ) {
			throw new Kohana_Exception( 'Loggly key :key must be a valid 36 character string',
				array( ':key' => $inputKey ) );
		}

		$this->_inputKey = $inputKey;
	}
	
	/**
	 * Generates the log message string and posts it to loggly.
	 *
	 * @param array $messages
	 * @return void
	 */
	public function write( array $messages ){

		$logString = '';
		
		foreach ( $messages as $message ) {
			foreach ( $message as $title => $body ) {
				if ( $title === 'level' ) {
					$body = $this->_log_levels[$body];
					$logString .= $body.'::';
				} else if ( $title === 'body' ) {
					$logString .= $body;
				}
			}
		}
		
		$request = Request::factory( 'https://logs.loggly.com/inputs/' . $this->_inputKey )->headers( 'content-type', 'test/plain' )->body( $logString );
		$response = $request->execute();
	}
}
	
