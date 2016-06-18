// Urdu OpenPad
// Written by Nabeel Hasan Naqvi (simunaqv [at] gmail [dot] com)
// Visit the support forums at http://www.urduweb.org/mehfil
// This code is public domain. Redistribution and use of this code, with or without modification, is permitted.

var osk=false;
var	isIE;
var	isGecko;
var	isSafari;
var	isKonqueror;
var	isOpera;
var currEdit2;
var IsUrdu2=1;
var IsUrdu3=1;
var gMode;

var gEditorId=null;
var	CurrentKeyboard;
var _sp;
var	LAlt;
var	RAlt;
var	RShift;
var	LShift;
var	LCtrl;
var	RCtrl;
var	HelpArea;
var	kbNormal=1;
var	kbShift=2;
var	kbAlt=3;
var	kbCtrl=4;
var	kbAltGr=5;
var	bToggleFlag=0;
var	CurrentKeyboardState=1;
var	currEdit=null;
var	langSel=1;
var	IsUrdu=1;
var	bCtrlState=0;
var	bAltState=0;
var	CurrentKeyboard;
var	Diacritics=new Array(0x0650, 0x064E,0x064B,	0x064F,	0x064D,	0x064C,	0x0651,	0x0652,	0x0670);
var	charSingleQuote=String.fromCharCode(39);
var	charDoubleQuote=String.fromCharCode(34);
var charSpace=String.fromCharCode(32);
var	ValidChars='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'+'-&=;,.?<>[]{}|/\\'+charSingleQuote+charSpace;
function _s(c){return String.fromCharCode(c)}
function isAlpha(ch)
{
    return (ch >= 'a' && ch	<= 'z\uffff') || (ch >=	'A'	&& ch <= 'Z\uffff');
}
function isDiacritic(c)
{
    for(i=0; i<Diacritics.length; i++)
    {
        if(c== Diacritics[i])
        {
            return true;
        }
    }
    return false;
}
function charCode(strChar)
{
    return strChar.charCodeAt(0);
}
function Key(x,	y,z	)
{
    this.normal=0;
    this.shifted=0;
    this.alt=0;
    this.normal=x;
    if(arguments.length>1)
    {
        this.shifted= y;
    }
    if(arguments.length>2)
    {
        this.alt= z;
    }
}
function KeyHelp(x,y)
{
    this.normal=x;
    this.shifted=y
}
function Keyboard()
{
    this.Keys= new Array();
    this.Shifted= new Array();
    this.AltGr=	new	Array();
    this.MultiChar=	new	Array();
    
    this.AddKey=function(ch, x, y, z)
    {
		//alert(ch+' '+x+' '+y+' '+z);
		this.Keys[ch]=new Key(x);
		
		if(arguments.length>2)
		{
			this.Shifted[ch]= y;
			//alert(this.Shifted[ch]);
		}
		
		if(arguments.length>3)
		{
			this.AltGr[ch]= z;
			//alert(this.AltGr[ch]);
		}
    }
}


var UrduPhonetic= new Keyboard();
UrduPhonetic.Keys['a']=new Key(0x0627, 0x0622, 0x0623);
UrduPhonetic.Keys['b']=new Key(0x0628, 0x0628, 0x202E);
UrduPhonetic.Keys['c']=new Key(0x0686, 0x062B, 0x202A);
UrduPhonetic.Keys['d']=new Key(0x062F, 0x0688);
UrduPhonetic.Keys['e']=new Key(0x0639, 0x0651, 0x0611);
UrduPhonetic.Keys['f']=new Key(0x0641, 0x64D);
UrduPhonetic.Keys['g']=new Key(0x06AF, 0x063A);
UrduPhonetic.Keys['h']=new Key(0x06BE, 0x062D, 0x0612);
UrduPhonetic.Keys['i']=new Key(0x06CC, 0x0670, 0x656);
UrduPhonetic.Keys['j']=new Key(0x062C, 0x0636);
UrduPhonetic.Keys['k']=new Key(0x06A9, 0x062E);
UrduPhonetic.Keys['l']=new Key(0x0644, 0x064C);
UrduPhonetic.Keys['m']=new Key(0x0645, 0x64B, 0x200F);
UrduPhonetic.Keys['n']=new Key(0x0646, 0x06BA, 0x202B);
UrduPhonetic.Keys['o']=new Key(0x06C1, 0x06C3, 0x06C2);
UrduPhonetic.Keys['p']=new Key(0x067E, 0x064F);
UrduPhonetic.Keys['q']=new Key(0x0642);
UrduPhonetic.Keys['r']=new Key(0x0631, 0x0691, 0x0613);
UrduPhonetic.Keys['s']=new Key(0x0633 , 0x0635, 0x610);
UrduPhonetic.Keys['t']=new Key(0x062A , 0x0679);
UrduPhonetic.Keys['u']=new Key(0x0626 , 0x0621);
UrduPhonetic.Keys['v']=new Key(0x0637, 0x0638, 0x202C);
UrduPhonetic.Keys['w']=new Key(0x0648, 0x0624, 0xFDFA);
UrduPhonetic.Keys['x']=new Key(0x0634, 0x0698, 0x202D);
UrduPhonetic.Keys['y']=new Key(0x06D2, 0x0601);
UrduPhonetic.Keys['z']=new Key(0x0632, 0x0630, 0x200E);

UrduPhonetic.AddKey('1', 0x0031, charCode('!'), 0x661);
UrduPhonetic.AddKey('2', 0x0032, charCode('@'), 0x662);
UrduPhonetic.AddKey('3', 0x0033, charCode('#'), 0x663);
UrduPhonetic.AddKey('4', 0x0034, charCode('$'), 0x664);
UrduPhonetic.AddKey('5', 0x0035, charCode('%'), 0x665);
UrduPhonetic.AddKey('6', 0x0036, charCode('^'), 0x666);
UrduPhonetic.AddKey('7', 0x0037, charCode('&'), 0x667);
UrduPhonetic.AddKey('8', 0x0038, charCode('*'), 0x668);
UrduPhonetic.AddKey('9', 0x0039, charCode('('), 0x669);
UrduPhonetic.AddKey('0', 0x0030, charCode(')'), 0x661);

UrduPhonetic.Keys['=']=new Key(0x0602);
UrduPhonetic.Keys['-']=new Key(0x002D);
UrduPhonetic.Keys[',']=new Key(0x060C);
UrduPhonetic.Keys[_s(46)]=new Key(0x06D4);
UrduPhonetic.Keys['/']=new Key(0x002F);
UrduPhonetic.Keys['\\']=new Key(0x060E);
UrduPhonetic.Keys[';']=new Key(0x061B);
UrduPhonetic.Keys['[']=new Key(0x201C);
UrduPhonetic.Keys[']']=new Key(0x201D);
UrduPhonetic.Keys[charSingleQuote]=new Key(39);
UrduPhonetic.Keys['~']=new Key(0x64C); //(0x0653);
UrduPhonetic.Keys[' ']=new Key(32);
UrduPhonetic.Keys['<']=new Key(0x064E);
UrduPhonetic.Keys['´']=new Key(0x0657);

UrduPhonetic.Shifted['!']=charCode('!');
UrduPhonetic.Shifted['@']=0x0600;
UrduPhonetic.Shifted['#']=0x0654;
UrduPhonetic.Shifted['$']=0x0655;
UrduPhonetic.Shifted['%']=0x060F;
UrduPhonetic.Shifted['^']=0x0652;
UrduPhonetic.Shifted['~']=0x064C; 
//UrduPhonetic.Shifted['&']=0x00BB;
UrduPhonetic.Shifted['*']=0x064C;
UrduPhonetic.Shifted['(']=0x0028;
UrduPhonetic.Shifted[')']=0x0029;

UrduPhonetic.Shifted['+']=0x0614;
UrduPhonetic.Shifted['_']=0x0640;

UrduPhonetic.Shifted['>']=0x0650; 
UrduPhonetic.Shifted['<']=0x064E; 
UrduPhonetic.Shifted['?']=0x061F; 
UrduPhonetic.Shifted['|']=0x0603; 
UrduPhonetic.Shifted['{']=0x2018; 
UrduPhonetic.Shifted['}']=0x2019; 
UrduPhonetic.Shifted[charDoubleQuote]=0x0022; 
UrduPhonetic.Shifted['~']=0x0653;
UrduPhonetic.Shifted[':']=0x003A; 
UrduPhonetic.Shifted[';']=0x061B;
UrduPhonetic.Shifted[' ']=0x200C; 

UrduPhonetic.AltGr['[']=0x201C; 
UrduPhonetic.AltGr[']']=0x201D; 
UrduPhonetic.AltGr['{']=0x2018; 
UrduPhonetic.AltGr['}']=0x2019; 

var	KeyMaps= new Array();
var	Keypads=new	Array();
var	langArray=new Array();



function isValidChar(sChar)
{
    if(ValidChars.indexOf(sChar)>=0)
    {
        return true;
    }
    return false;
}
function processKeyup(evt)
{
    if (!langArray[currEdit.id]) return;
    evt	= (evt)	? evt :	((event) ? event : null);
    if (evt)
    {
        var	charCode = (evt.charCode) ?	evt.charCode : evt.keyCode;
        if(charCode	== 17)
        {
            CurrentKeyboardState = kbNormal;
        }
    }
}
function Downkeys(evt)
{
	
    evt	= (evt)	? evt :	(window.event) ? event : null;
    if(evt)
    {
        if(document.all)
        {
            if(evt.shiftKey	)
            {
				CurrentKeyboardState=kbShift;
				
            }
            else if(evt.ctrlKey	&& evt.altKey)
            {
				CurrentKeyboardState=kbAlt;
            }
            else if(evt.ctrlKey)
            {
                CurrentKeyboardState=kbCtrl;
            }
        }
        else if(!document.all && document.getElementById)
        {
            if(evt.ctrlKey)
            {
                if(	evt.shiftKey)
                {
					CurrentKeyboardState=kbAlt;
                }
                else
                {
                    CurrentKeyboardState=kbCtrl;
                }
            }
            else if(evt.shiftKey )
            {
				CurrentKeyboardState=kbShift;
            }
        }
    }
}
function Upkeys(evt)
{	
	
    evt	= (evt)	? evt :	(window.event) ? event : null;
    var	charCode = (evt.charCode) ?	evt.charCode : evt.keyCode;
    if(evt)
    {
        if (CurrentKeyboardState ==	kbCtrl)
        {
            CurrentKeyboardState = kbNormal;
        }
        if(CurrentKeyboardState	== kbShift)
        {
            if(!evt.shiftKey)
            {
				CurrentKeyboardState = kbNormal;
            }
        }
        if(CurrentKeyboardState	== kbAlt)
        {
            if(document.all)
            {
                if(!(evt.altKey	&& evt.ctrlKey))
                {
					CurrentKeyboardState = kbNormal;
                }
            }
            else if(!document.all && document.getElementById)
            {
                if(!evt.ctrlKey	|| evt.shiftKey)
                {
					CurrentKeyboardState=kbNormal;
                }
            }
        }
    }
}
function storeCaret	(textEl)
{
    if (textEl.createTextRange)
    textEl.caretPos	= document.selection.createRange().duplicate();
}


function processKeydown(evt)
{
    if (!currEdit) return;
    //evt	= (evt)	? evt :	((event) ? event : null);
    evt	= (evt)	? evt :	(window.event) ? event : null;
    if (evt)
    {
        var	charCode = (evt.charCode) ?	evt.charCode : evt.keyCode;
        //alert(charCode);
        var idx= String.fromCharCode(charCode);
        var	idxChar;
        
        if(isAlpha(idx))
        {			
			idxChar=String.fromCharCode(charCode).toLowerCase();
        }
        
        if (CurrentKeyboardState ==	kbAlt)
        {
			if(isAlpha(idx))
				AddText(idxChar);
			else
				AddText(idx);
            //ToggleKeyboard(kbNormal);
        }
        if(charCode	== 17)
        {
            CurrentKeyboardState = kbCtrl;
        }
        else if(CurrentKeyboardState ==	kbCtrl)
        {
            if(charCode==32)
            {
                if(!currEdit.getAttribute('OpenPadId'))
				{
					if(langArray[currEdit.name]==1)
					{
						setEnglish(currEdit.name);
					}
					else
					{
						setUrdu(currEdit.name);
					}
				}
				else
				{
					if(langArray[currEdit.id]==1)
					{
						setEnglishById(currEdit.id);
					}
					else
					{
						setUrduById(currEdit.id);
					}
				}
				
                if(isIE)
                {
                    evt.returnValue=false;
                    evt.cancelBubble=true;
                }
                else if(isGecko)
                {
                    evt.preventDefault();
                    evt.stopPropagation();
                }
            }
        }
    }
}

	function AddText2(text) 
	{
	
		if(!currEdit) return;
	 
		if (currEdit.createTextRange && currEdit.caretPos) {      
			var caretPos = currEdit.caretPos;      
			caretPos.text = caretPos.text.charAt(caretPos.text.length - 1) == ' ' ?
			text + ' ' : text;
			currEdit.focus(caretPos);
		}
		else if (currEdit.selectionStart || currEdit.selectionStart == '0') 
		{ 
			var vTop=currEdit.scrollTop;
			//alert(vTop);
			var startPos = currEdit.selectionStart; 
			var endPos = currEdit.selectionEnd; 
			currEdit.value = currEdit.value.substring(0, startPos) 
						  + text 
						  + currEdit.value.substring(endPos, currEdit.value.length); 
			currEdit.focus(); 
			currEdit.selectionStart = startPos + 1; 
			currEdit.selectionEnd = startPos + 1; 
			currEdit.scrollTop=vTop;
		}
		else 
		{
			currEdit.value += text;
			currEdit.focus(caretPos);	
		}
    }
    
function AddText(idx)
{
    var	txt;
    if(!currEdit) return;
    var	idxChar= idx;

    
    if(isAlpha(idxChar))
    {
		idxChar= idxChar.toLowerCase();
		var	sId= idxChar.toUpperCase();
    }
    
    switch(CurrentKeyboardState)
    {
        case kbNormal:
			if(CurrentKeyboard.Keys[idxChar] !=	null)
			{
				txt= String.fromCharCode(CurrentKeyboard.Keys[idxChar].normal);
			}
			break;
        
        case kbShift:
       
			if (isAlpha(idxChar))
			{
				if (CurrentKeyboard.MultiChar[sId])
				{
					txt=CurrentKeyboard.MultiChar[sId];
					//ToggleKeyboard(kbShift);
				}
				else if(CurrentKeyboard.Keys[idxChar] != null)
				{			
					if(CurrentKeyboard.Keys[idxChar].shifted !=	null)
					{
						if(CurrentKeyboard.Keys[idxChar].shifted)
						{
							txt= String.fromCharCode(CurrentKeyboard.Keys[idxChar].shifted);
						}
						//ToggleKeyboard(kbShift);
					}
				}
			}
			else if (CurrentKeyboard.Shifted[idxChar] != null)
			{
				//alert(idx);
				txt= String.fromCharCode(CurrentKeyboard.Shifted[idxChar]);
				//ToggleKeyboard(kbShift);
				
			}
	   

	        
			break;
        case kbAlt:
			if (isAlpha(idxChar))
			{
				if(CurrentKeyboard.Keys[idxChar] !=	null)
				if(CurrentKeyboard.Keys[idxChar].alt !=	null)
				{
					txt= String.fromCharCode(CurrentKeyboard.Keys[idxChar].alt);
					//ToggleKeyboard(kbAlt);
				}
			}
			else if (CurrentKeyboard.AltGr[idxChar] != null)
			{
				txt= String.fromCharCode(CurrentKeyboard.AltGr[idxChar]);
				//ToggleKeyboard(kbAlt);
				
			}
			break;
    }
    
    if(txt==null)
		return;
	//alert(txt);
		
	if(window.opera)
	{
		var	vTop=currEdit.scrollTop;
        var	startPos = currEdit.selectionStart;
        var	endPos = currEdit.selectionEnd;
        currEdit.value = currEdit.value.substring(0, startPos)
        + txt
        + currEdit.value.substring(endPos, currEdit.value.length);
        currEdit.focus();
        currEdit.selectionStart	= startPos + 1;
        currEdit.selectionEnd =	startPos + 1;
        currEdit.scrollTop=vTop;
	}
    else if (currEdit.createTextRange &&	currEdit.caretPos)
    {
        var	caretPos = currEdit.caretPos;
        caretPos.text =	caretPos.text.charAt(caretPos.text.length -	1) == '	' ?
        txt	+ '	' :	txt;
        currEdit.focus(caretPos);
    }
    else if	(currEdit.selectionStart ||	currEdit.selectionStart	== '0')
    {
        var	vTop=currEdit.scrollTop;
        var	startPos = currEdit.selectionStart;
        var	endPos = currEdit.selectionEnd;
        currEdit.value = currEdit.value.substring(0, startPos)
        + txt
        + currEdit.value.substring(endPos, currEdit.value.length);
        currEdit.focus();
        currEdit.selectionStart	= startPos + 1;
        currEdit.selectionEnd =	startPos + 1;
        currEdit.scrollTop=vTop;
    }
    else
    {
        currEdit.value += txt;
        currEdit.focus(caretPos);
    }
}
function processKeypresses(evt)
{
    if(!currEdit.getAttribute('OpenPadId'))
	{
		if (!langArray[currEdit.name]) return;
	}
	else
	{
		if (!langArray[currEdit.id]) return;
	}
		
    if (!currEdit) return;
    evt	= (evt)	? evt :	(window.event) ? event : null;
    if (evt)
    {
        var	charCode = (evt.charCode) ?	evt.charCode :
        ((evt.keyCode) ? evt.keyCode :
        ((evt.which) ? evt.which : 0));
        var	whichASC = charCode	;       
        var	whichChar =	String.fromCharCode(whichASC);
        var	idxChar= whichChar.toLowerCase(whichChar);
		var	sId;
		
		if((charCode==13))
		{
			return;
		}

        if(isIE)
        {			
            if(CurrentKeyboardState== kbAlt)
            {
                evt.keyCode=0;
                return;
            }
            
            if(isAlpha(idxChar))
			{
				idxChar= idxChar.toLowerCase();
				sId= idxChar.toUpperCase();
			}
		    
			switch(CurrentKeyboardState)
			{
				case kbNormal:
					if(CurrentKeyboard.Keys[idxChar] !=	null)
					{
						evt.keyCode = CurrentKeyboard.Keys[idxChar].normal;
					}
					break;
		        
				case kbShift:
		       
					if (isAlpha(idxChar))
					{
						if(CurrentKeyboard.Keys[idxChar] != null)
						{			
							if(CurrentKeyboard.Keys[idxChar].shifted !=	null)
							{
								if(CurrentKeyboard.Keys[idxChar].shifted)
								{
									evt.keyCode = CurrentKeyboard.Keys[idxChar].shifted;
								}
								//ToggleKeyboard(kbShift);
							}
						}
					}
					else if (CurrentKeyboard.Shifted[idxChar] != null)
					{
						evt.keyCode = CurrentKeyboard.Shifted[idxChar];
						//ToggleKeyboard(kbShift);
						
					}
			   

			        
					break;
				case kbAlt:
					if (isAlpha(idxChar))
					{
						if(CurrentKeyboard.Keys[idxChar] !=	null)
						if(CurrentKeyboard.Keys[idxChar].alt !=	null)
						{
							evt.keyCode= CurrentKeyboard.Keys[idxChar].alt;
							//ToggleKeyboard(kbAlt);
						}
					}
					else if (CurrentKeyboard.AltGr[idxChar] != null)
					{
						evt.keyCode = CurrentKeyboard.AltGr[idxChar];
						//ToggleKeyboard(kbAlt);
						
					}
					break;
			}

            return;           
        }
        else if(isGecko)
        {	
			var fCode;
			//alert(evt.charCode+" "+evt.keyCode);
			charCode = evt.charCode;
			
			if (charCode==0)
			{
				return;
			}
			
			whichASC = charCode	;       
			whichChar =	String.fromCharCode(whichASC);
			idxChar= whichChar.toLowerCase(whichChar);
			
			if((charCode==8) ||  (charCode==13) || (charCode==37) || (charCode==39) ||  (charCode==38)|| (charCode==40)|| (charCode==33) ||  (charCode==34) ||  (charCode==50)  ) return;
			
			if(evt.ctrlKey && evt.altKey)
			{
				if (isAlpha(idxChar))
				{
					if(CurrentKeyboard.Keys[idxChar] !=	null)
					if(CurrentKeyboard.Keys[idxChar].alt !=	null)
					{
						txt= String.fromCharCode(CurrentKeyboard.Keys[idxChar].alt);
					}
				}
				else if (CurrentKeyboard.AltGr[idxChar] != null)
				{
					txt= String.fromCharCode(CurrentKeyboard.AltGr[idxChar]);
				}
				
				var	vTop=currEdit.scrollTop;
				var	startPos = currEdit.selectionStart;
				var	endPos = currEdit.selectionEnd;
				currEdit.value = currEdit.value.substring(0, startPos)
				+ txt
				+ currEdit.value.substring(endPos, currEdit.value.length);
				currEdit.focus();
				currEdit.selectionStart	= startPos + 1;
				currEdit.selectionEnd =	startPos + 1;
				currEdit.scrollTop=vTop;
					
				evt.preventDefault();
				evt.stopPropagation();
				return;
			}
		
				
			if(!(CurrentKeyboardState == kbCtrl))
			{
				AddText(whichChar);
				evt.preventDefault();
				evt.stopPropagation();
			}
			
        }
        else if(window.opera)
        {
			//alert(charCode);
			if((charCode==13) || (charCode==37) || (charCode==39) ||  (charCode==38)|| (charCode==40)|| (charCode==33) || (charCode==32) || (charCode==34) || (charCode==46) || (charCode==50)  ) return;
						
			if(!(CurrentKeyboardState == kbCtrl))
			{
				AddText(idxChar);
				//evt.keyCode = codes[whichChar];
				evt.preventDefault();
				evt.stopPropagation();	
			}			
        }
    }
}
function d(s){document.writeln(s);};
function w(c,s){d('<td class="btnFlat"  width=6% onclick="javascript:AddText2(\''+s+'\' );">'+c+'</td>');}
function w2(c,s){d('<td class="btnFlat" onclick="javascript:AddText2(\''+s+'\' );">'+c+'</td>');}
function writeKeyboard(){d('<span dir="ltr">');d('<table   width="100%" style="border: 1px solid #C0C0C0;">');d('<tr>');w('ر','ر');w('ذ','ذ');w('ڈ','ڈ');w('د','د');w('خ','خ');w('ح','ح');w('چ','چ');w('ج','ج');w('ث','ث');w('ٹ','ٹ');w('ت','ت');w('پ','پ');w('ب','ب');w('آ','آ');w('ا','ا');d('</tr><tr>');w('گ','گ');w('ک','ک');w('ق','ق');w('ف','ف');w('غ','غ');w('ع','ع');w('ظ','ظ');w('ط','ط');w('ض','ض');w('ص','ص');w('ش','ش');w('س','س');w('ژ','ژ');w('ز','ز');w('ڑ','ڑ');d('</tr>');d('<tr>');d('<TD >&nbsp;</TD >');w('؟','؟');w('۔','۔');w('ے','ے');w('ی','ی');w('ئ','ئ');w('ء','ء');w('ھ','ھ');w('ہ','ہ');w('ؤ','ؤ');w('و','و');w('ں','ں');w('ن','ن');w('م','م');w('ل','ل');d('</tr>');d('<tr>');d('<td width="100%" colspan="15">');d('<table align=right style="border: 1px solid #D3D3D3;" colspan="15">');d('<tr>');w2('کوما',String.fromCharCode(0x060C));w2('تشدید',String.fromCharCode(0x0651));w2('کھڑی زبر',String.fromCharCode(0x0670));w2('درمیانی حمزہ',String.fromCharCode(0x0626));w2('دو زیر',String.fromCharCode(0x064D));w2('دو زبر',String.fromCharCode(0x064B));w2(' پیش ',String.fromCharCode(0x064F));w2('زبر',String.fromCharCode(0x064E));w2('زیر',String.fromCharCode(0x0650));d('</tr>');d('</table>');d('</td>');d('</tr>');d('</table>');d('</span>');}
function r(e){e=(e)?e:(window.event)?event:null;if(e.srcElement){var el=e.srcElement;className=el.className;if(className=='btnFlat'||className=='btnLowered'){el.className='btnRaised';}}else if(e.target){var el=e.target;className=el.className;if(className=='btnFlat'||className=='btnLowered'){el.className='btnRaised';}}}
function n(e){e=(e)?e:(window.event)?event:null;if(e.srcElement){var el=window.event.srcElement;className=el.className;if(className=='btnRaised'||className=='btnLowered'){el.className='btnFlat';}}else if(e.target){var el=e.target;className=el.className;if(className=='btnRaised'||className=='btnLowered'){el.className='btnFlat';}}}
function l(e){e=(e)?e:(window.event)?event:null;if(e.srcElement){var el=window.event.srcElement;className=el.className;if(className=='btnFlat'||className=='btnRaised'){el.className='btnLowered';}}else if(e.target){var el=e.target;className=el.className;if(className=='btnFlat'||className=='btnRaised'){el.className='btnLowered';}}}


function setEditor(evt)
{
	if(window.opera)
	{
		currEdit=window.event.srcElement;
	}
	if(isGecko)
	{
		currEdit=evt.target;		
	}
	else
		currEdit=window.event.srcElement;
}

function setUrduById(idx)
{
	setUrdu(idx, true);
}

function setEnglishById(idx)
{
	setEnglish(idx, true);
}

function setEnglish(idx, byId)
{

	var el;
	if(arguments.length >1)
	{
		if(byId)
			el= document.getElementById(idx);
		else
			el= change(idx); 
	}
	else
	{
		el= change(idx); 
	}
	
	langArray[idx]=0;
	el.style.backgroundColor="";
	if (el.createTextRange) 
	{
		var caretPos = el.caretPos;
		el.focus(caretPos);
		currEdit=el;
	}
	else if (el.selectionStart || el.selectionStart == '0')
	{
		var startPos = el.selectionStart; 
		el.focus(); 
		currEdit=el;
		el.selectionStart = startPos + 1; 
		el.selectionEnd = startPos + 1;
	}
}

function setUrdu(idx, byId)
{
	var el;
	if(arguments.length >1)
	{
		if(byId)
			el= document.getElementById(idx);
		else
			el= change(idx); 
	}
	else
	{
		el= change(idx); 
	}
	
	langArray[idx]=1;
	el.focus(1);
	el.style.backgroundColor="";
	if (el.createTextRange) 
	{
		var caretPos = el.caretPos;
		el.focus(caretPos);
		currEdit=el;
	}
	else if (el.selectionStart || el.selectionStart == '0')
	{
		var startPos = el.selectionStart; 
		el.focus(); 
		currEdit=el;
		el.selectionStart = startPos + 1; 
		el.selectionEnd = startPos + 1;
	}
}

function writeToggleControl(idx, byId)
{
	var strName= idx+"_toggle";
	
	if(arguments.length >1)
	{
		if(byId)
			document.writeln('<span class="smallfonteng10">English<input type="radio" value="English" name="'+strName+'"onclick=\'setEnglishById("'+idx+'")\'>&#1575;&#1585;&#1583;&#1608;<input type="radio" value="Urdu" checked name="'+strName+'" onclick=\'setUrduById("'+idx+'")\'></span>');		
	}
	else
	{
		document.writeln('<span class="smallfonteng10">English<input type="radio" value="English" name="'+strName+'"onclick=\'setEnglish("'+idx+'")\'>&#1575;&#1585;&#1583;&#1608;<input type="radio" value="Urdu" checked name="'+strName+'" onclick=\'setUrdu("'+idx+'")\'></span>'); 
	}
}

function insertToggleControl(idx, byId)
{
	var strName= idx+"_toggle";
	var el;
	
	if(arguments.length >1)
	{
		if(byId)
		{
			el= document.getDocumentById(idx);
			
			if(null==el) return;
			var lineBR=document.createElement("br");
			el.parentNode.insertBefore(lineBR, el.nextSibling);
			var toggleSpan= document.createElement("span");
			toggleSpan.innerHTML='English<input type="radio" value="English" name="'+strName+'"onclick=\'setEnglishById("'+idx+'")\'>&#1575;&#1585;&#1583;&#1608;<input type="radio" value="Urdu" checked name="'+strName+'" onclick=\'setUrduById("'+idx+'")\'>';
			//document.writeln('English<input type="radio" value="English" name="'+strName+'"onclick=\'setEnglish("'+idx+'")\'>&#1575;&#1585;&#1583;&#1608;<input type="radio" value="Urdu" checked name="'+strName+'" onclick=\'setUrdu("'+idx+'")\'>'); 
			lineBR.parentNode.insertBefore(toggleSpan, lineBR.nextSibling);
			var lineBR2=document.createElement("br");
			el.parentNode.insertBefore(lineBR2, toggleSpan.nextSibling);
			//document.writeln('English<input type="radio" value="English" name="'+strName+'"onclick=\'setEnglishById("'+idx+'")\'>&#1575;&#1585;&#1583;&#1608;<input type="radio" value="Urdu" checked name="'+strName+'" onclick=\'setUrduById("'+idx+'")\'>');		
		}
	}
	else
	{
		el= change(idx);
		if(null==el) return;
		var lineBR=document.createElement("br");
		el.parentNode.insertBefore(lineBR, el.nextSibling);
		var toggleSpan= document.createElement("span");
		toggleSpan.style.width="200px";
		toggleSpan.innerHTML='  انگریزی  <input type="radio" value="English" title="To Write English Click this Radio Button" name="'+strName+'"onclick=\'setEnglish("'+idx+'")\'>  &#1575;&#1585;&#1583;&#1608;  <input type="radio" value="Urdu" title="To Write Urdu Click this Radio Button" checked name="'+strName+'" onclick=\'setUrdu("'+idx+'")\'>';
		//document.writeln('English<input type="radio" value="English" name="'+strName+'"onclick=\'setEnglish("'+idx+'")\'>&#1575;&#1585;&#1583;&#1608;<input type="radio" value="Urdu" checked name="'+strName+'" onclick=\'setUrdu("'+idx+'")\'>'); 
		lineBR.parentNode.insertBefore(toggleSpan, lineBR.nextSibling);
		var lineBR2=document.createElement("br");
		el.parentNode.insertBefore(lineBR2, toggleSpan.nextSibling);
	}		
}

function change(strName)
{
	var result=null;
	allInputs= document.getElementsByTagName('input');
		
	for (var i = 0; i < allInputs.length; i++) 
	{
		thisInput = allInputs[i];
		if(thisInput.type == 'text')
		{			
			if(thisInput.name == strName)				
				return thisInput;
		}
	}
	
	allTextAreas= document.getElementsByTagName('textarea');
	for (i = 0; i < allTextAreas.length; i++) 
	{
		thisTextArea= allTextAreas[i];				
		if(thisTextArea.name == strName)				
			return thisTextArea;		
	}
	return null;
}

function addEvent(obj, evType, fn){
	
  /*if (window.opera && obj.addEventListener)
  {
	obj.addEventListener(evType, fn, false);
    return true;
  }	
  else */
  if (obj.addEventListener)
  {
    obj.addEventListener(evType, fn, true);
    return true;
  }
  else if (obj.attachEvent)
  {
    var r = obj.attachEvent("on"+evType, fn);	
    return r;
  }
  else
  {
    alert("Handler could not be attached");
  }
}


function makeUrduEditorById(idx, pt)
{
	langArray[idx]=1;
	var el= document.getElementById(idx);
	
	el.setAttribute("OpenPadId", idx);
	if(null==el)
		return;
	setAttributes(el, pt);
}

function makeUrduEditor(idx, pt)
{		
	langArray[idx]=1;	
	var el= change(idx);
	
	if(null==el)
		return;
	setAttributes(el, pt);		
}

function setAttributes(el, pt)
{
	el.lang="ur";
	el.dir="rtl";
	el.onFocus= "setEditor(el)";
	el.onclick="storeCaret(el)";
	el.onkeyup="storeCaret(el)";

	el.wrap="soft";
	with(el.style)
	{
		fontFamily="Jameel Noori Nastaleeq, Alvi Nastaleeq, Nafees Web Naskh, Urdu Naskh Asiatype, Tahoma";
		fontSize="13pt";
		backgroundColor="";
	}
	
	addEvent(el , "keypress",  processKeypresses);
	addEvent(el , "keydown",  processKeydown);
	addEvent(el , "keyup",  processKeyup);
	addEvent(el , "focus", setEditor);	
}

function setKeymap(keymapName)
{
    CurrentKeyboard= KeyMaps[keymapName];
    //UpdateKeypad(kbNormal);
}


function AddEditor(sName)
{
    langArray[sName]=1;
}

function makeUrduEditors(editors)
{
	var strName;
	var iSize;
	
	for(var xtextEl in editors)
	{
		strName= xtextEl;
		iSize= editors[xtextEl];
		makeUrduEditor(strName, iSize);
	}
}

function makeUrduEditorsById(editors)
{
	var strName;
	var iSize;
	

	for(var xtextEl in editors)
	{
		strName= xtextEl;
		iSize= editors[xtextEl];
		makeUrduEditorById(strName, iSize);
	}
}

function initUrduEditor()
{
    var	ua = navigator.userAgent.toLowerCase();
    isIE = ((ua.indexOf("msie")	!= -1) && (ua.indexOf("opera") == -1) && (ua.indexOf("webtv") == -1));
    isGecko	= (ua.indexOf("gecko") != -1);
    isSafari = (ua.indexOf("safari") !=	-1);
    isKonqueror	= (ua.indexOf("konqueror") != -1);
    isOpera	= window.opera;
   
	var allInputs, thisInput, attr;
	var allTextAreas, thisTextArea;
	var editors;
	
	var ua = navigator.userAgent.toLowerCase();
	isIE = ((ua.indexOf("msie") != -1) && (ua.indexOf("opera") == -1) && (ua.indexOf("webtv") == -1)); 
	isGecko = (ua.indexOf("gecko") != -1);
	isOpera= window.opera;

	var _se = document.getElementsByTagName('script');
		for (var i=0; i<_se.length; i++) {
		if (_se[i].src && (_se[i].src.indexOf("OpenPad.js") != -1) )
		{			
			_x=_se[i].src.indexOf("OpenPad.js");
			_sp=_se[i].src.substring(0,_x);		
		}
	}
	

	//document.writeln('<style type="text/css">@import "'+_sp+'OpenPad.css";</style>');
    
    document.onmouseover=r;
	document.onmouseout=n;
	document.onmousedown=l;
	document.onmouseup=r
    addEvent(document, "keydown", Downkeys);
    addEvent(document, "keyup",	Upkeys);
    KeyMaps["UrduPhonetic"]=UrduPhonetic;
    setKeymap("UrduPhonetic");    
}