# Log Email

This module is a Log_Writer for [Kohana](http://kohanaframework.org/) that will send all log messages to a [Loggly](http://loggly.com/) input.

### Installing the Module

The best way to include the module in your project is to link to it as a submodule [see Kohana's git guide](http://kohanaframework.org/3.0/guide/kohana/tutorials/git)
{
git submodule add git://github.com/hpoom/kohana-loggly.git modules/log_loggly
git submodule init
}

Alternativly you can download the source from GitHub and place it into modules/log_loggly in your project.

### Using the Module

Find this line in your bootstrap.php
`Kohana::$log->attach(new Log_File(APPPATH.'logs'));`

Change this to be as follows
`Kohana::$log->attach( new Log_Loggly( $logglyKey ) );`

Where $logglyKey is your Loggly Input Key which can be obtained from your Loggly account.
