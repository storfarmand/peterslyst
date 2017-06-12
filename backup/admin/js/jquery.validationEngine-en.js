

(function($) {
	$.fn.validationEngineLanguage = function() {};
	$.validationEngineLanguage = {
		newLang: function() {
			$.validationEngineLanguage.allRules = 	{
                    "payconditions":{
                        "regex":"none",
                        "alertTextCheckboxe":"* Du skal læse og acceptere betalingsbetingelserne"},
                    "required":{                // Add your regex rules here, you can take telephone as an example
                        "regex":"none",
                        "alertText":"* Dette felt skal udfyldes",
                        "alertTextCheckboxMultiple":"* Vælg i menuen",
                        "alertTextCheckboxe":"* Denne checkbox skal markeres"},
					"length":{
						"regex":"none",
						"alertText":"*Mellem ",
						"alertText2":" og ",
						"alertText3": " antal karakterer tilladt"},
					"maxCheckbox":{
						"regex":"none",
						"alertText":"* Du har nået maksimum"},	
					"minCheckbox":{
						"regex":"none",
						"alertText":"* Vælg mindst ",
						"alertText2":" mugligheder"},	
					"confirm":{
						"regex":"none",
						"alertText":"* Inhold stemmer ikke"},		
					"telephone":{
						"regex":"/^[0-9\-\(\)\ ]+$/",
						"alertText":"* Forkert tlf nummer"},	
					"email":{
						"regex":"/^[a-zA-Z0-9_\.\-]+\@([a-zA-Z0-9\-]+\.)+[a-zA-Z0-9]{2,4}$/",
						"alertText":"* Forkert email adresse"},	
					"date":{
                         "regex":"/^[0-9]{4}\-\[0-9]{1,2}\-\[0-9]{1,2}$/",
                         "alertText":"* Forkert dato, formatet skal være YYYY-MM-DD"},
					"onlyNumber":{
						"regex":"/^[0-9\ ]+$/",
						"alertText":"* Kun tal"},	
					"noSpecialCaracters":{
						"regex":"/^[0-9a-zA-Z]+$/",
						"alertText":"* Ingen special karakterer"},	
					"ajaxUser":{
						"file":"validateUser.php",
						"extraData":"name=eric",
						"alertTextOk":"* This user is available",	
						"alertTextLoad":"* Loading, please wait",
						"alertText":"* This user is already taken"},	
					"ajaxName":{
						"file":"validateUser.php",
						"alertText":"* This name is already taken",
						"alertTextOk":"* This name is available",	
						"alertTextLoad":"* Loading, please wait"},		
					"onlyLetter":{
						"regex":"/^[a-zA-Z\ \']+$/",
						"alertText":"* Kun bogstaver"},
					"validate2fields":{
    					"nname":"validate2fields",
    					"alertText":"* You must have a firstname and a lastname"}	
					}	
					
		}
	}
})(jQuery);

$(document).ready(function() {	
	$.validationEngineLanguage.newLang()
});