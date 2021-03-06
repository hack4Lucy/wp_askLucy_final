<?php

/**
 * The Notices Class
 *
 * This is a helper class to display notices.
 *
 */
class Zopim_Notices
{
  protected static $instance = NULL;
  protected $notices = array();

  /*
   * get an instance of this class
   */
  public static function get_instance()
  {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self();
    }

    return self::$instance;
  }

  /**
   * Returns the current notices defined.
   *
   * @return array
   */
  public function get_notices()
  {
    return $this->notices;
  }

  /*
   * Add Notice
   *
   * An internal function to add a notice to a specific context, where
   * contexts are "places" that display notice messages, such as
   * 'login_form' or 'tickets_widget'. The $text is the text to display
   * and the $type is either 'note', 'confirm', or 'alert' which
   * differs in colors when output.
   *
   */
  public function add_notice( $context, $text, $type = 'note' )
  {
    if ( isset( $this->notices[ $context . '_' . $type ] ) ) {
      $this->notices[ $context . '_' . $type ][ ] = $text;
    } else {
      $this->notices[ $context . '_' . $type ] = array( $text );
    }
  }

  /*
   * Do Notices
   *
   * Process all the added notices for a specific context and output
   * them on screen using the _notice function. Loops through notes,
   * confirms and alerts for the given context.
   *
   */
  public function do_notices( $context )
  {
    echo '<div class="zopim-notices-group">';
    foreach ( array( 'error', 'notice' ) as $type ) {
      if ( isset( $this->notices[ $context . '_' . $type ] ) ) {
        $notices = $this->notices[ $context . '_' . $type ];

        foreach ( $notices as $notice ) {
          $this->_notice( $notice, $type );
        }
      }
    }
    echo '</div>';
  }

  /*
   * Notice
   *
   * Prints the notice to screen given a certain $type, which can be
   * 'note', 'alert' and 'confirm' according to the stylesheets.
   *
   */
  private function _notice( $text, $type = 'note' )
  {
    ?>
    <div class="zopim-admin-notice zopim-<?php echo $type; ?>">
      <p><?php echo $text; ?></p>
    </div>
  <?php
  }

}
