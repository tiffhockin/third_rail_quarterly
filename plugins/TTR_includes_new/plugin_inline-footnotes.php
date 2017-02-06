<?php

/**
 * @package Simple (Inline) Footnotes
 * @version 1.0
 * @author TH, based on Andrew Nacin's [Simple Footnotes](http://wordpress.org/extend/plugins/simple-footnotes)
 * Use the <code>[note]</code> shortcode ([note]Footnote.[/note]). This shortcode takes no parameters.
 */

class inline_footnotes {

	var $footnotes = array();

	function inline_footnotes() {
		// [note] ... [/note]
		// register the shortcode
		add_shortcode( 'note', array( &$this, 'shortcode' ) );

		add_filter( 'the_content', array( &$this, 'the_content' ), 12 );
		// if ( !is_admin() )
		// 	return;
		// add_action( 'admin_init', array( &$this, 'admin_init' ) );

	}
	function shortcode( $atts, $content = null ) {
		global $id;
		if ( null === $content )
			return;
		if ( !isset ( $this->footnotes[$id] ) )
			$this->footnotes[$id] = array( 0 => false );
		$this->footnotes[$id][] = $content;
		$note = count( $this->footnotes[$id] ) - 1;
		return '<a href="#" class="note-maker">' . $note . '</a><span class="inline-note">' . $content . '</span>';
	}
	function the_content( $content ) {
		return $this->footnotes( $content );
	}
	function footnotes( $content ) {
		global $id;
		if ( empty( $this->footnotes[$id] ) )
			return $content;
		return $content;
	}
}
new inline_footnotes();

?>