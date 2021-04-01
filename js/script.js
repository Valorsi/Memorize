function closeErrorWindow() {
    var errorWindow = document.getElementById('errorMessage');

    errorWindow.remove();
}


// On Keydown & Keyup
// limitField = this.form.message (message is the name of the form)
// limitCount = this.form.countdown (countdown is the name of the input we use for displaying the characters)
// limitNum = an integer we input in the HTML that is the limit of characters for this field
function limitText(limitField, limitCount, limitNum) {

    //if the length of the value of the field is bigger than the limit
        if (limitField.value.length > limitNum) {
    
            // substring() Extract parts of a string at the given Indices.
            // "Cuts" off any character after the position of the limitNum (300 in our case)
            // e.g. if i paste 302 characters into the field, the 2 characters over the limit are removed
            
            limitField.value = limitField.value.substring(0, limitNum);
    
        } 
        
        else 
            //else if the length of the value of the field is smaller than the limit
        {
            //change the value of the limitCount inputfield by the amount of characters in the field
            limitCount.value = limitNum - limitField.value.length;
    
        }
    
    }