<?php
/*
 * Copyright (C) 2012 by TEQneers GmbH & Co. KG
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

/**
 * Form Element Password Class
 *
 * @author		Oliver G. Mueller <mueller@teqneers.de>
 * @package		PHPKnock
 * @subpackage	Classes
 * @copyright	Copyright (C) 2003-2012 TEQneers GmbH & Co. KG. All rights reserved
 */

/**
 * Form Element Password Class
 *
 * This class represents a single html form element of type password.
 *
 * @package		PHPKnock
 * @subpackage	Classes
 */
class FormElementPassword extends FormElement {

	#######################################################################
	# attributes
	#######################################################################


	#######################################################################
	# methods
	#######################################################################
	/**
	 * CONSTRUCTOR
	 *
	 * @param	string	$name			Name of form
	 * @param	string	$label			Label content
	 */
	function __construct( $name, $label ) {
		$this->_name	= $name;
		$this->_label	= $label;
	}


	#######################################################################
	# data methods
	#######################################################################


	#######################################################################
	# output methods
	#######################################################################
	/**
	 * Generate HTML form output for element
	 *
	 * @return	string			HTML output
	 */
	public function htmlFormRow() {
		$attr			= array();
		//		$attr['class']	= $this->formClass();

		$labelAttr	= Html::array2attributes( $attr );

		$label	= '<label '.Html::array2attributes( $attr ).'>';

		if( $this->hint() != '' ) {
			// show help cursor when a hint is given and the mouse hovers above the label
			$label	.= '<span style="cursor:help;" title="'.htmlentities( $this->hint(), ENT_QUOTES, CHARSET, true ).'">'.$this->label().'</span>';
		} else {
			$label	.= $this->label();
		}
		$label	.= '</label>';


		if( $this->isEmpty() && $this->defaultValue() !== null ) {
			$this->setDbValue( $this->defaultValue() );
		}

		// define HTML attributes for input field
		$attr	= array(
			'type'			=> 'password',
			'name'			=> 'data['.$this->name().']',
			'value'			=> null,
//			'class'			=> $this->formClass(),
			'onkeypress'	=> 'if( event.keyCode==13 || event.which==13) this.form.submit();'
		);

		$value	= '<input '.Html::array2attributes( $attr ).' />';
		$ret	= '
		<tr><td '.$labelAttr.'>'.$label.'</td><td>'.$value.$this->htmlErrorMessage().'</td></tr>';
		return $ret;
	}




	#######################################################################
	# accessor methods
	#######################################################################
	/**
	 * Accessor
	 *
	 * @see		setValidRegExp()
	 * @see		validate()
	 * @return	string		Valid PCRE compatible regular expression
	 */
	public function validRegExp() {
		return $this->_validRegExp;
	}


	/**
	 * Accessor
	 *
	 * If this value is set to anything not empty, the value will be validated
	 * against this regular expression (PCRE compatible, not POSIX!).
	 * This value might produce an {@link setError()} if the regular expression
	 * is not found in {@link value()}.
	 *
	 * Example:
	 * An element which will only exept numbers as a valid input:
	 * <code>
	 *   $element->setValidRegExp( '/^[0-9]+$/' );
	 * </code>
	 *
	 * @see		validRegExp()
	 * @param	string	$regExp			Valid regular expression (PCRE)
	 * @return	FormElementText			Return $this for fluent interface (method chaining)
	 */
	public function setValidRegExp( $regExp ) {
		$this->_validRegExp	= $regExp;

		return $this;
	}





}
?>