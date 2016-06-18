/*
Author: Tristan Denyer (based on Charlie Griefer's original clone code, and some great help from Dan - see his comments in blog post)
Plugin repo: https://github.com/tristandenyer/Clone-section-of-form-using-jQuery
Demo at http://tristandenyer.com/using-jquery-to-duplicate-a-section-of-a-form-maintaining-accessibility/
Ver: 0.9.5.0
Last updated: Oct 23, 2015

The MIT License (MIT)

Copyright (c) 2011 Tristan Denyer

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
$(function () {
    $('#btnAdd').click(function () {
        var num     = $('.clonedInput').length, // Checks to see how many "duplicatable" input fields we currently have
            newNum  = new Number(num + 1),      // The numeric ID of the new input field being added, increasing by 1 each time
            newElem = $('#accused' + num).clone().attr('id', 'accused' + newNum).fadeIn('slow'); // create the new element via clone(), and manipulate it's ID using newNum value
    
    /*  This is where we manipulate the name/id values of the input inside the new, cloned element
        Below are examples of what forms elements you can clone, but not the only ones.
        There are 2 basic structures below: one for an H2, and one for form elements.
        To make more, you can copy the one for form elements and simply update the classes for its label and input.
        Keep in mind that the .val() method is what clears the element when it gets cloned. Radio and checkboxes need .val([]) instead of .val('').
    */
        // H2 - section
        newElem.find('.heading-reference').attr('id', 'reference_' + newNum).attr('name', 'reference_' + newNum).html('Accused #' + newNum);

        // Name - text
        newElem.find('.label_acsd_name').attr('for', 'acsd_name_' + newNum).attr('for', 'acsd_name_' + newNum).html('Accused Name ' + newNum);
        newElem.find('.acsd_name').attr('id', 'acsd_name_' + newNum ).attr('name', 'acsd_name_' + newNum).val('');

        // CNIC - text
        newElem.find('.label_acsd_cnic').attr('for', 'acsd_cnic_' + newNum).attr('for', 'acsd_cnic_' + newNum).html('Accused CNIC ' + newNum);
        newElem.find('.acsd_cnic').attr('id', 'acsd_cnic_' + newNum).attr('name', 'acsd_cnic_' + newNum).val('');

        // Address - text
        newElem.find('.label_acsd_addr').attr('for', 'acsd_addr_' + newNum).attr('for', 'acsd_addr_' + newNum).html('Accused Address ' + newNum);
        newElem.find('.acsd_addr').attr('id', 'acsd_addr_' + newNum).attr('name', 'acsd_addr_' + newNum).val('');
		
		// Onbail-UTP - text
        newElem.find('.label_onbail_utp').attr('for', 'onbail_utp_' + newNum).attr('for', 'onbail_utp_' + newNum).html('On-Bail/UTP ' + newNum);
        newElem.find('.onbail_utp').attr('id', 'onbail_utp_' + newNum).attr('name', 'onbail_utp_' + newNum).val('');


    // Insert the new element after the last "duplicatable" input field
        $('#accused' + num).after(newElem);
        $('#acsd_name_' + newNum).focus();

    // Enable the "remove" button. This only shows once you have a duplicated section.
        $('#btnDel').attr('disabled', false);

    // Right now you can only add 4 sections, for a total of 5. Change '5' below to the max number of sections you want to allow.
        if (newNum == 10)
        $('#btnAdd').attr('disabled', true).prop('value', "You've reached the limit"); // value here updates the text in the 'add' button when the limit is reached 
    });

    $('#btnDel').click(function () {
    // Confirmation dialog box. Works on all desktop browsers and iPhone.
        if (confirm("Are you sure you wish to remove this section? This cannot be undone."))
            {
                var num = $('.clonedInput').length;
                // how many "duplicatable" input fields we currently have
                $('#accused' + num).slideUp('slow', function () {$(this).remove();
                // if only one element remains, disable the "remove" button
                    if (num -1 === 1)
                $('#btnDel').attr('disabled', true);
                // enable the "add" button
                $('#btnAdd').attr('disabled', false).prop('value', "add section");});
            }
        return false; // Removes the last section you added
    });
    // Enable the "add" button
    $('#btnAdd').attr('disabled', false);
    // Disable the "remove" button
    $('#btnDel').attr('disabled', true);
});