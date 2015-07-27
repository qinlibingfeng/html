var contextPath = '/issues';// Variables used as maps to store the original text and html of some fields whose values get replaced by
// renderer previews.
var origHtml = new Object();
var origText = new Object();
var origPreviewLink = new Object();

/*
 * Used to submit and restore a renderer preview. This relies of the DWR library and the generated
 * RendererPreviewAjaxUtil.js bean, which performs the server-side access.
 */
function toggleRenderPreview(fieldId, fieldName, rendererType, issueKey)
{
    if(origHtml[fieldId] == null)
    {
        // this is a hack for Safari/dwr since safari does not seem to generate an XMLHTTPRequest correctly see JRA-8354
        if(encodeURI(document.getElementById(fieldId).value).length > 2500 && navigator.userAgent.indexOf('Safari') >= 0)
        {
          // first open the new window
          window.open('', 'wiki_renderer_preview', 'width=780, height=575, resizable, scrollbars=yes');

          // then form submit to the window, we have to form submit because the error we are trying to get around
          // is the max size limit for a GET param value
          var previewForm = document.createElement('form');
          previewForm.action = '/issues/secure/WikiRendererPreviewAction.jspa?rendererType='+ rendererType + '&issueKey=' + issueKey + '&fieldName='+ encodeURI(fieldName);
          previewForm.method = 'POST';
          previewForm.target = 'wiki_renderer_preview';
          var unrenderedMarkup = document.createElement('input');
          unrenderedMarkup.name = 'unrenderedMarkup';
          unrenderedMarkup.type = 'hidden';
          unrenderedMarkup.value= document.getElementById(fieldId).value;
          previewForm.appendChild(unrenderedMarkup);

          var bodys = document.getElementsByTagName('BODY');
          bodys[0].appendChild(previewForm);
          previewForm.submit();
        }
        else
        {
          showWaitImage(true, fieldId);
          RendererPreviewAjaxUtil.getPreviewHtml(renderPreviewCallback(fieldId), rendererType, document.getElementById(fieldId).value, issueKey);
        }
    }
    else
    {
        document.getElementById(fieldId + "-temp").name = fieldId + "-temp";
        // clear the height before we reset
        xHeight(fieldId + "-edit", null);
        document.getElementById(fieldId + "-edit").innerHTML = origHtml[fieldId];
        document.getElementById(fieldId).value = origText[fieldId];
        origHtml[fieldId] = null;
        document.getElementById(fieldId + "-edit").className = "";
        document.getElementById(fieldId + "-preview_link").innerHTML = "<img alt='"+ "preview" +"' title='" + "preview" +"' class='unselectedPreview' border='0' width='18' height='18' src='/issues/images/icons/fullscreen.gif'>";
    }
    return false;
}

/*
* This is the call-back function for the AJAX call to the RendererPreviewAjaxUtil getPreviewHtml call. This
* function replaces the input with the renderered content.
*/
var renderPreviewCallback = function(fieldId)
{
    return function(data)
    {
        var origHeight = xHeight(fieldId + "-edit", null);
        origHtml[fieldId] = document.getElementById(fieldId + "-edit").innerHTML;
        origText[fieldId] = document.getElementById(fieldId).value;
        document.getElementById(fieldId + "-temp").value = origText[fieldId];
        document.getElementById(fieldId + "-temp").name = fieldId;
        showWaitImage(false, fieldId );
        document.getElementById(fieldId + "-preview_link").innerHTML = "<img alt='"+ "edit' title='" + "edit" + "' class='selectedPreview' width='18' height='18' src='/issues/images/icons/fullscreen.gif'>";
        document.getElementById(fieldId + "-edit").className = "previewClass";
        document.getElementById(fieldId + "-edit").innerHTML = data;
        var newHeight = xHeight(fieldId + "-edit", null);
        if(newHeight < origHeight)
        {
           xHeight(fieldId + "-edit", origHeight);
        }
    }
}

function showWaitImage(flag, fieldId)
{
    var waitImageHtml = "<img id='" + fieldId + "-wait_image' alt='Wait Image' border='0' src='/issues/images/icons/wait.gif'>";
    if(flag)
    {
      origPreviewLink[fieldId] = document.getElementById(fieldId + "-preview_link_div").innerHTML;
      document.getElementById(fieldId + "-preview_link_div").innerHTML = waitImageHtml;
    }
    else
    {
      document.getElementById(fieldId +  "-preview_link_div").innerHTML = origPreviewLink[fieldId];
      origPreviewLink[fieldId] = null;
    }
}

// xHeight, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xHeight(e,h)
{
  if(!(e=xGetElementById(e))) return 0;
  if (xNum(h)) {
    if (h<0) h = 0;
    else h=Math.round(h);
  }
  else h=-1;
  var css=xDef(e.style);
  if (e == document || e.tagName.toLowerCase() == 'html' || e.tagName.toLowerCase() == 'body') {
    h = xClientHeight();
  }
  else if(css && xDef(e.offsetHeight) && xStr(e.style.height)) {
    if(h>=0) {
      var pt=0,pb=0,bt=0,bb=0;
      if (document.compatMode=='CSS1Compat') {
        var gcs = xGetComputedStyle;
        pt=gcs(e,'padding-top',1);
        if (pt !== null) {
          pb=gcs(e,'padding-bottom',1);
          bt=gcs(e,'border-top-width',1);
          bb=gcs(e,'border-bottom-width',1);
        }
        // Should we try this as a last resort?
        // At this point getComputedStyle and currentStyle do not exist.
        else if(xDef(e.offsetHeight,e.style.height)){
          e.style.height=h+'px';
          pt=e.offsetHeight-h;
        }
      }
      h-=(pt+pb+bt+bb);
      if(isNaN(h)||h<0)
      {
        return;
      }
      else
      {
        e.style.height=h+'px';
      }
    }
    else
    {
        e.style.height="";
    }
    h=e.offsetHeight;
  }
  else if(css && xDef(e.style.pixelHeight)) {
    if(h>=0) e.style.pixelHeight=h;
    if(h==-1) e.style.pixelHeight="";
    h=e.style.pixelHeight;
  }
  return h;
}/* x-jira.js compiled from X 4.0 with XC 0.27b. Distributed by GNU LGPL. For copyrights, license, documentation and more visit Cross-Browser.com */
// globals, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

var xOp7Up,xOp6Dn,xIE4Up,xIE4,xIE5,xNN4,xUA=navigator.userAgent.toLowerCase();
if(window.opera){
  var i=xUA.indexOf('opera');
  if(i!=-1){
    var v=parseInt(xUA.charAt(i+6));
    xOp7Up=v>=7;
    xOp6Dn=v<7;
  }
}
else if(navigator.vendor!='KDE' && document.all && xUA.indexOf('msie')!=-1){
  xIE4Up=parseFloat(navigator.appVersion)>=4;
  xIE4=xUA.indexOf('msie 4')!=-1;
  xIE5=xUA.indexOf('msie 5')!=-1;
}
else if(document.layers){xNN4=true;}
xMac=xUA.indexOf('mac')!=-1;
// xAddEventListener, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL
                                                      
function xAddEventListener(e,eT,eL,cap)
{
  if(!(e=xGetElementById(e))) return;
  eT=eT.toLowerCase();
  if((!xIE4Up && !xOp7Up) && e==window) {
    if(eT=='resize') { window.xPCW=xClientWidth(); window.xPCH=xClientHeight(); window.xREL=eL; xResizeEvent(); return; }
    if(eT=='scroll') { window.xPSL=xScrollLeft(); window.xPST=xScrollTop(); window.xSEL=eL; xScrollEvent(); return; }
  }
  var eh='e.on'+eT+'=eL';
  if(e.addEventListener) e.addEventListener(eT,eL,cap);
  else if(e.attachEvent) e.attachEvent('on'+eT,eL);
  else eval(eh);
}
// called only from the above
function xResizeEvent()
{
  if (window.xREL) setTimeout('xResizeEvent()', 250);
  var cw = xClientWidth(), ch = xClientHeight();
  if (window.xPCW != cw || window.xPCH != ch) { window.xPCW = cw; window.xPCH = ch; if (window.xREL) window.xREL(); }
}
function xScrollEvent()
{
  if (window.xSEL) setTimeout('xScrollEvent()', 250);
  var sl = xScrollLeft(), st = xScrollTop();
  if (window.xPSL != sl || window.xPST != st) { window.xPSL = sl; window.xPST = st; if (window.xSEL) window.xSEL(); }
}
// xClientHeight, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xClientHeight()
{
  var h=0;
  if(xOp6Dn) h=window.innerHeight;
  else if(document.compatMode == 'CSS1Compat' && !window.opera && document.documentElement && document.documentElement.clientHeight)
    h=document.documentElement.clientHeight;
  else if(document.body && document.body.clientHeight)
    h=document.body.clientHeight;
  else if(xDef(window.innerWidth,window.innerHeight,document.width)) {
    h=window.innerHeight;
    if(document.width>window.innerWidth) h-=16;
  }
  return h;
}
// xClientWidth, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xClientWidth()
{
  var w=0;
  if(xOp6Dn) w=window.innerWidth;
  else if(document.compatMode == 'CSS1Compat' && !window.opera && document.documentElement && document.documentElement.clientWidth)
    w=document.documentElement.clientWidth;
  else if(document.body && document.body.clientWidth)
    w=document.body.clientWidth;
  else if(xDef(window.innerWidth,window.innerHeight,document.height)) {
    w=window.innerWidth;
    if(document.height>window.innerHeight) w-=16;
  }
  return w;
}
// xDef, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xDef()
{
  for(var i=0; i<arguments.length; ++i){if(typeof(arguments[i])=='undefined') return false;}
  return true;
}
// xEvent, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xEvent(evt) // object prototype
{
  var e = evt || window.event;
  if(!e) return;
  if(e.type) this.type = e.type;
  if(e.target) this.target = e.target;
  else if(e.srcElement) this.target = e.srcElement;

  // Section B
  if (e.relatedTarget) this.relatedTarget = e.relatedTarget;
  else if (e.type == 'mouseover' && e.fromElement) this.relatedTarget = e.fromElement;
  else if (e.type == 'mouseout') this.relatedTarget = e.toElement;
  // End Section B

  if(xOp6Dn) { this.pageX = e.clientX; this.pageY = e.clientY; }
  else if(xDef(e.pageX,e.pageY)) { this.pageX = e.pageX; this.pageY = e.pageY; }
  else if(xDef(e.clientX,e.clientY)) { this.pageX = e.clientX + xScrollLeft(); this.pageY = e.clientY + xScrollTop(); }

  // Section A
  if (xDef(e.offsetX,e.offsetY)) {
    this.offsetX = e.offsetX;
    this.offsetY = e.offsetY;
  }
  else if (xDef(e.layerX,e.layerY)) {
    this.offsetX = e.layerX;
    this.offsetY = e.layerY;
  }
  else {
    this.offsetX = this.pageX - xPageX(this.target);
    this.offsetY = this.pageY - xPageY(this.target);
  }
  // End Section A
  
  if (e.keyCode) { this.keyCode = e.keyCode; } // for moz/fb, if keyCode==0 use which
  else if (xDef(e.which) && e.type.indexOf('key')!=-1) { this.keyCode = e.which; }

  this.shiftKey = e.shiftKey;
  this.ctrlKey = e.ctrlKey;
  this.altKey = e.altKey;
}

//  I need someone with IE/Mac to compare test snippets 1 and 2 in section A.
  
//  // Snippet 1
//  if(xDef(e.offsetX,e.offsetY)) {
//    this.offsetX = e.offsetX;
//    this.offsetY = e.offsetY;
//    if (xIE4Up && xMac) {
//      this.offsetX += xScrollLeft();
//      this.offsetY += xScrollTop();
//    }
//  }
//  else if (xDef(e.layerX,e.layerY)) {
//    this.offsetX = e.layerX;
//    this.offsetY = e.layerY;
//  }
//  else {
//    this.offsetX = this.pageX - xPageX(this.target);
//    this.offsetY = this.pageY - xPageY(this.target);
//  }

//  // Snippet 2
//  if (xDef(e.offsetX,e.offsetY) && !(xIE4Up && xMac)) {
//    this.offsetX = e.offsetX;
//    this.offsetY = e.offsetY;
//  }
//  else if (xDef(e.layerX,e.layerY)) {
//    this.offsetX = e.layerX;
//    this.offsetY = e.layerY;
//  }
//  else {
//    this.offsetX = this.pageX - xPageX(this.target);
//    this.offsetY = this.pageY - xPageY(this.target);
//  }

//  This was in section B:

//  if (e.relatedTarget) this.relatedTarget = e.relatedTarget;
//  else if (xIE4Up) {
//    if (e.type == 'mouseover') this.relatedTarget = e.fromElement;
//    else if (e.type == 'mouseout') this.relatedTarget = e.toElement;
//  }
//  changed to remove sniffer after discussion with Hallvord

// Possible optimization:

//  if (e.keyCode) { this.keyCode = e.keyCode; } // for moz/fb, if keyCode==0 use which
//  else if (xDef(e.which) && e.type.indexOf('key')!=-1) { this.keyCode = e.which; }
//  // replace the above 2 lines with the following?
//  // this.keyCode = e.keyCode || e.which || 0;
// xGetComputedStyle, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xGetComputedStyle(oEle, sProp, bInt)
{
  var s, p = 'undefined';
  var dv = document.defaultView;
  if(dv && dv.getComputedStyle){
    s = dv.getComputedStyle(oEle,'');
    if (s) p = s.getPropertyValue(sProp);
  }
  else if(oEle.currentStyle) {
    // convert css property name to object property name for IE
    var a = sProp.split('-');
    sProp = a[0];
    for (var i=1; i<a.length; ++i) {
      c = a[i].charAt(0);
      sProp += a[i].replace(c, c.toUpperCase());
    }   
    p = oEle.currentStyle[sProp];
  }
  else return null;
  return bInt ? (parseInt(p) || 0) : p;
}

// xGetElementById, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xGetElementById(e)
{
  if(typeof(e)!='string') return e;
  if(document.getElementById) e=document.getElementById(e);
  else if(document.all) e=document.all[e];
  else e=null;
  return e;
}
// xGetElementsByTagName, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xGetElementsByTagName(t,p)
{
  var list = null;
  t = t || '*';
  p = p || document;
  if (xIE4 || xIE5) {
    if (t == '*') list = p.all;
    else list = p.all.tags(t);
  }
  else if (p.getElementsByTagName) list = p.getElementsByTagName(t);
  return list || new Array();
}
// xNum, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xNum()
{
  for(var i=0; i<arguments.length; ++i){if(isNaN(arguments[i]) || typeof(arguments[i])!='number') return false;}
  return true;
}
// xPageX, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xPageX(e)
{
  if (!(e=xGetElementById(e))) return 0;
  var x = 0;
  while (e) {
    if (xDef(e.offsetLeft)) x += e.offsetLeft;
    e = xDef(e.offsetParent) ? e.offsetParent : null;
  }
  return x;
}
// xPageY, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xPageY(e)
{
  if (!(e=xGetElementById(e))) return 0;
  var y = 0;
  while (e) {
    if (xDef(e.offsetTop)) y += e.offsetTop;
    e = xDef(e.offsetParent) ? e.offsetParent : null;
  }
//  if (xOp7Up) return y - document.body.offsetTop; // v3.14, temporary hack for opera bug 130324 (reported 1nov03)
  return y;
}
// xScrollLeft, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xScrollLeft(e, bWin)
{
  var offset=0;
  if (!xDef(e) || bWin || e == document || e.tagName.toLowerCase() == 'html' || e.tagName.toLowerCase() == 'body') {
    var w = window;
    if (bWin && e) w = e;
    if(w.document.documentElement && w.document.documentElement.scrollLeft) offset=w.document.documentElement.scrollLeft;
    else if(w.document.body && xDef(w.document.body.scrollLeft)) offset=w.document.body.scrollLeft;
  }
  else {
    e = xGetElementById(e);
    if (e && xNum(e.scrollLeft)) offset = e.scrollLeft;
  }
  return offset;
}
// xScrollTop, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xScrollTop(e, bWin)
{
  var offset=0;
  if (!xDef(e) || bWin || e == document || e.tagName.toLowerCase() == 'html' || e.tagName.toLowerCase() == 'body') {
    var w = window;
    if (bWin && e) w = e;
    if(w.document.documentElement && w.document.documentElement.scrollTop) offset=w.document.documentElement.scrollTop;
    else if(w.document.body && xDef(w.document.body.scrollTop)) offset=w.document.body.scrollTop;
  }
  else {
    e = xGetElementById(e);
    if (e && xNum(e.scrollTop)) offset = e.scrollTop;
  }
  return offset;
}
// xStr, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xStr(s)
{
  for(var i=0; i<arguments.length; ++i){if(typeof(arguments[i])!='string') return false;}
  return true;
}
// xWidth, Copyright 2001-2005 Michael Foster (Cross-Browser.com)
// Part of X, a Cross-Browser Javascript Library, Distributed under the terms of the GNU LGPL

function xWidth(e,w)
{
  if(!(e=xGetElementById(e))) return 0;
  if (xNum(w)) {
    if (w<0) w = 0;
    else w=Math.round(w);
  }
  else w=-1;
  var css=xDef(e.style);
  if (e == document || e.tagName.toLowerCase() == 'html' || e.tagName.toLowerCase() == 'body') {
    w = xClientWidth();
  }
  else if(css && xDef(e.offsetWidth) && xStr(e.style.width)) {
    if(w>=0) {
      var pl=0,pr=0,bl=0,br=0;
      if (document.compatMode=='CSS1Compat') {
        var gcs = xGetComputedStyle;
        pl=gcs(e,'padding-left',1);
        if (pl !== null) {
          pr=gcs(e,'padding-right',1);
          bl=gcs(e,'border-left-width',1);
          br=gcs(e,'border-right-width',1);
        }
        // Should we try this as a last resort?
        // At this point getComputedStyle and currentStyle do not exist.
        else if(xDef(e.offsetWidth,e.style.width)){
          e.style.width=w+'px';
          pl=e.offsetWidth-w;
        }
      }
      w-=(pl+pr+bl+br);
      if(isNaN(w)||w<0) return;
      else e.style.width=w+'px';
    }
    w=e.offsetWidth;
  }
  else if(css && xDef(e.style.pixelWidth)) {
    if(w>=0) e.style.pixelWidth=w;
    w=e.style.pixelWidth;
  }
  return w;
}
/**
 * A bunch of useful utilitiy javascript methods available to all jira pages
 */


/**
 * Adds Ctrl+Enter submit functions to textarea elements
 *
 */
window.onload = function ()
{
    var textAreas = xGetElementsByTagName('textarea');
    for (var i = 0; i < textAreas.length; i++) 
    {
        xAddEventListener(textAreas[i], 'keypress', submitOnCtrlEnter);
    }
}

/*
 * Submits an element's form if the enter key is pressed
 */
function submitOnEnter(e) 
{
    var xe = new xEvent(e);
    var targetObject = xe.target;
    if (xe.keyCode  == 13 && targetObject.form)
    {
        targetObject.form.submit();
    }
}

/*
Submits an element's form if the enter key and the control key is pressed
*/
function submitOnCtrlEnter(e) 
{
    var xe = new xEvent(e);
    var targetObject = xe.target;
    if (xe.ctrlKey && (xe.keyCode  == 13 || xe.keyCode == 10 ) && targetObject.form)
    {
        targetObject.form.submit();
        return false;
    }
    return true;
}


/*
Returns a space delimited value of a select list. There's strangely no in-built way of doing this for multi-selects
*/
function getMultiSelectValues(selectObject) 
{
    var selectedValues = '';
    for (var i = 0; i < selectObject.length; i++)
    {
        if(selectObject.options[i].selected)
        {
            if (selectObject.options[i].value && selectObject.options[i].value.length > 0)
                selectedValues = selectedValues + ' ' + selectObject.options[i].value;
        }
    }

    return selectedValues;
}

function getMultiSelectValuesAsArray(selectObject)
{
    var selectedValues = new Array();
    for (var i = 0; i < selectObject.length; i++)
    {
        if(selectObject.options[i].selected)
        {
            if (selectObject.options[i].value && selectObject.options[i].value.length > 0)
                selectedValues[selectedValues.length] = selectObject.options[i].value;
        }
    }
    return selectedValues;
}

/*
  Returns true if the value is the array
*/
function arrayContains(array, value)
{
    for (var i = 0; i < array.length; i++)
    {
        if (array[i] == value)
        {
            return true;
        }
    }

    return false;
}

/*
Adds a class name to the given element
*/
function addClassName(elementId, classNameToAdd) 
{
    var elem = document.getElementById(elementId);
    if (elem)
    {
        elem.className = elem.className + ' ' + classNameToAdd;
    }
}

/*
 Removes all class names to from the given element
 */
function removeClassName(elementId, classNameToRemove) 
{
    var elem = document.getElementById(elementId);
    if (elem)
    {
        elem.className = (' ' + elem.className + ' ').replace(' ' + classNameToRemove + ' ', ' ');
    }
}

/*
    Returns the field as an encoded string (assuming that the id == the field name
*/
function getEscapedFieldValue(id)
{

    var e = document.getElementById(id);

    if (e.value)
    {
        return id + '=' + encodeURIComponent(e.value);
    }
    else
    {
        return '';
    }
}

/*
    Returns a concatenated version of getEscapedFieldValue
*/
function getEscapedFieldValues(ids)
{
    var s = '';
    for (i = 0; i < ids.length; i++)
    {
        s = s + '&' + getEscapedFieldValue(ids[i]);
    }
    return s;
}

/* Manages Gui Preferences and stores them in the user's cookie. */
var GuiPrefs = {
    toggleVisibility: function(elementId) {
        var elem = document.getElementById(elementId);
        if (elem)
        {
            if (readFromConglomerateCookie("jira.conglomerate.cookie", elementId, '1') == '1')
            {
                elem.style.display = "none";
                removeClassName(elementId + 'header', 'headerOpened');
                addClassName(elementId + 'header', 'headerClosed');
                saveToConglomerateCookie("jira.conglomerate.cookie", elementId, '0');
            }
            else
            {
                elem.style.display = "";
                removeClassName(elementId + 'header', 'headerClosed');
                addClassName(elementId + 'header', 'headerOpened');
                eraseFromConglomerateCookie("jira.conglomerate.cookie", elementId);
            }
        }
    }
};

/*
 Toggles hide / unhide an element. Also attemots to change the "elementId + header" element to have the headerOpened / headerClosed class.
 Also saves the state in a cookie
 DEPRECATED: use GuiPrefs.toggleVisibility
*/
function toggle(elementId) 
{
    GuiPrefs.toggleVisibility(elementId);
}

function toggleDivsWithCookie(elementShowId, elementHideId)
{
    var elementShow = document.getElementById(elementShowId);
    var elementHide = document.getElementById(elementHideId);
    if (elementShow.style.display == 'none')
    {
        elementHide.style.display = 'none';
        elementShow.style.display = 'block';
        saveToConglomerateCookie("jira.viewissue.cong.cookie", elementShowId, '1');
        saveToConglomerateCookie("jira.viewissue.cong.cookie", elementHideId, '0');
    }
    else
    {
        elementShow.style.display = 'none';
        elementHide.style.display = 'block';
        saveToConglomerateCookie("jira.viewissue.cong.cookie", elementHideId, '1');
        saveToConglomerateCookie("jira.viewissue.cong.cookie", elementShowId, '0');
    }
}

/*
 Similar to toggle. Run this on page load.
*/
function restoreDivFromCookie(elementId, cookieName, defaultValue)
{
    if (defaultValue == null)
        defaultValue = '1';

    var elem = document.getElementById(elementId);
    if (elem)
    {
        if (readFromConglomerateCookie(cookieName, elementId, defaultValue) != '1')
        {
            elem.style.display = "none";
            removeClassName(elementId + 'header', 'headerOpened');
            addClassName(elementId + 'header', 'headerClosed')
        }
        else
        {
            elem.style.display = "";
            removeClassName(elementId + 'header', 'headerClosed');
            addClassName(elementId + 'header', 'headerOpened')
        }
    }
}

/*
 Similar to toggle. Run this on page load.
*/
function restore(elementId)
{
    restoreDivFromCookie(elementId, "jira.conglomerate.cookie", '1');
}

// Cookie handling functions

function saveToConglomerateCookie(cookieName, name, value)
{
    var cookieValue = getCookieValue(cookieName);
    cookieValue = addOrAppendToValue(name, value, cookieValue);

    saveCookie(cookieName, cookieValue, 365);
}

function readFromConglomerateCookie(cookieName, name, defaultValue)
{
    var cookieValue = getCookieValue(cookieName);
    var value = getValueFromCongolmerate(name, cookieValue);
    if(value != null)
    {
        return value;
    }

    return defaultValue;
}

function eraseFromConglomerateCookie(cookieName, name)
{
    saveToConglomerateCookie(cookieName, name,"");
}

function getValueFromCongolmerate(name, cookieValue)
{
    var newCookieValue = null;
    // a null cookieValue is just the first time through so create it
    if(cookieValue == null)
    {
        cookieValue = "";
    }
    var eq = name + "=";
    var cookieParts = cookieValue.split('|');
    for(var i = 0; i < cookieParts.length; i++) {
        var cp = cookieParts[i];
        while (cp.charAt(0)==' ') {
            cp = cp.substring(1,cp.length);
        }
        // rebuild the value string exluding the named portion passed in
        if (cp.indexOf(name) == 0) {
            return cp.substring(eq.length, cp.length);
        }
    }
    return null;
}

//either append or replace the value in the cookie string
function addOrAppendToValue(name, value, cookieValue)
{
    var newCookieValue = "";
    // a null cookieValue is just the first time through so create it
    if(cookieValue == null)
    {
        cookieValue = "";
    }

    var cookieParts = cookieValue.split('|');
    for(var i = 0; i < cookieParts.length; i++) {
        var cp = cookieParts[i];

        // ignore any empty tokens
        if(cp != "")
        {
            while (cp.charAt(0)==' ') {
                cp = cp.substring(1,cp.length);
            }
            // rebuild the value string exluding the named portion passed in
            if (cp.indexOf(name) != 0) {
                newCookieValue += cp + "|";
            }
        }
    }

    // always append the value passed in if it is not null or empty
    if(value != null && value != '')
    {
        var pair = name + "=" + value;
        if((newCookieValue.length + pair.length) < 4020)
        {
            newCookieValue += pair;
        }
    }
    return newCookieValue;
}

function getCookieValue(name)
{
    var eq = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i<ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') {
            c = c.substring(1,c.length);
        }
        if (c.indexOf(eq) == 0) {
            return c.substring(eq.length,c.length);
        }
    }

    return null;
}

function saveCookie(name,value,days)
{
  var ex;
  if (days) {
    var d = new Date();
    d.setTime(d.getTime()+(days*24*60*60*1000));
    ex = "; expires="+d.toGMTString();
  }
  else {
    ex = "";
  }
  document.cookie = name + "=" + value + ex + ( (contextPath) ? ";path=" + contextPath : ";path=/");
}

/*
Reads a cookie. If none exists, then it returns and 
*/
function readCookie(name, defaultValue)
{
  var cookieVal = getCookieValue(name);
  if(cookieVal != null)
  {
      return cookieVal;
  }

  // No cookie found, then save a new one as on!
  if (defaultValue)
  {
      saveCookie(name, defaultValue, 365);
      return defaultValue;
  }
  else
  {
      return null;
  }
}

function eraseCookie(name)
{
  saveCookie(name,"",-1);
}




















function DWREngine() { }





DWREngine.setErrorHandler = function(handler) {
DWREngine._errorHandler = handler;
};





DWREngine.setWarningHandler = function(handler) {
DWREngine._warningHandler = handler;
};





DWREngine.setTimeout = function(timeout) {
DWREngine._timeout = timeout;
};





DWREngine.setPreHook = function(handler) {
DWREngine._preHook = handler;
};





DWREngine.setPostHook = function(handler) {
DWREngine._postHook = handler;
};


DWREngine.XMLHttpRequest = 1;


DWREngine.IFrame = 2;






DWREngine.setMethod = function(newmethod) {
if (newmethod != DWREngine.XMLHttpRequest && newmethod != DWREngine.IFrame) {
DWREngine._handleError("Remoting method must be one of DWREngine.XMLHttpRequest or DWREngine.IFrame");
return;
}
DWREngine._method = newmethod;
};





DWREngine.setVerb = function(verb) {
if (verb != "GET" && verb != "POST") {
DWREngine._handleError("Remoting verb must be one of GET or POST");
return;
}
DWREngine._verb = verb;
};





DWREngine.setOrdered = function(ordered) {
DWREngine._ordered = ordered;
};





DWREngine.setAsync = function(async) {
DWREngine._async = async;
};





DWREngine.defaultMessageHandler = function(message) {
if (typeof message == "object" && message.name == "Error" && message.description) {
alert("Error: " + message.description);
}
else {
alert(message);
}
};





DWREngine.beginBatch = function() {
if (DWREngine._batch) {
DWREngine._handleError("Batch already started.");
return;
}

DWREngine._batch = {};
DWREngine._batch.map = {};
DWREngine._batch.paramCount = 0;
DWREngine._batch.map.callCount = 0;
DWREngine._batch.ids = [];
DWREngine._batch.preHooks = [];
DWREngine._batch.postHooks = [];
};





DWREngine.endBatch = function(options) {
var batch = DWREngine._batch;
if (batch == null) {
DWREngine._handleError("No batch in progress.");
return;
}

if (options && options.preHook) batch.preHooks.unshift(options.preHook);
if (options && options.postHook) batch.postHooks.push(options.postHook);
if (DWREngine._preHook) batch.preHooks.unshift(DWREngine._preHook);
if (DWREngine._postHook) batch.postHooks.push(DWREngine._postHook);

if (batch.method == null) batch.method = DWREngine._method;
if (batch.verb == null) batch.verb = DWREngine._verb;
if (batch.async == null) batch.async = DWREngine._async;
if (batch.timeout == null) batch.timeout = DWREngine._timeout;

batch.completed = false;


DWREngine._batch = null;



if (!DWREngine._ordered) {
DWREngine._sendData(batch);
DWREngine._batches[DWREngine._batches.length] = batch;
}
else {
if (DWREngine._batches.length == 0) {

DWREngine._sendData(batch);
DWREngine._batches[DWREngine._batches.length] = batch;
}
else {

DWREngine._batchQueue[DWREngine._batchQueue.length] = batch;
}
}
};






DWREngine._errorHandler = DWREngine.defaultMessageHandler;


DWREngine._warningHandler = DWREngine.defaultMessageHandler;


DWREngine._preHook = null;


DWREngine._postHook = null;


DWREngine._batches = [];


DWREngine._batchQueue = [];


DWREngine._handlersMap = {};


DWREngine._method = DWREngine.XMLHttpRequest;


DWREngine._verb = "POST";


DWREngine._ordered = false;


DWREngine._async = true;


DWREngine._batch = null;


DWREngine._timeout = 0;


DWREngine._DOMDocument = ["Msxml2.DOMDocument.5.0", "Msxml2.DOMDocument.4.0", "Msxml2.DOMDocument.3.0", "MSXML2.DOMDocument", "MSXML.DOMDocument", "Microsoft.XMLDOM"];


DWREngine._XMLHTTP = ["Msxml2.XMLHTTP.5.0", "Msxml2.XMLHTTP.4.0", "MSXML2.XMLHTTP.3.0", "MSXML2.XMLHTTP", "Microsoft.XMLHTTP"];










DWREngine._execute = function(path, scriptName, methodName, vararg_params) {
var singleShot = false;
if (DWREngine._batch == null) {
DWREngine.beginBatch();
singleShot = true;
}

var args = [];
for (var i = 0; i < arguments.length - 3; i++) {
args[i] = arguments[i + 3];
}

if (DWREngine._batch.path == null) {
DWREngine._batch.path = path;
}
else {
if (DWREngine._batch.path != path) {
DWREngine._handleError("Can't batch requests to multiple DWR Servlets.");
return;
}
}


var params;
var callData;
var firstArg = args[0];
var lastArg = args[args.length - 1];

if (typeof firstArg == "function") {
callData = { callback:args.shift() };
params = args;
}
else if (typeof lastArg == "function") {
callData = { callback:args.pop() };
params = args;
}
else if (typeof lastArg == "object" && lastArg.callback != null && typeof lastArg.callback == "function") {
callData = args.pop();
params = args;
}
else if (firstArg == null) {



if (lastArg == null && args.length > 2) {
if (DWREngine._warningHandler) {
DWREngine._warningHandler("Ambiguous nulls at start and end of parameter list. Which is the callback function?");
}
}
callData = { callback:args.shift() };
params = args;
}
else if (lastArg == null) {
callData = { callback:args.pop() };
params = args;
}
else {
if (DWREngine._warningHandler) {
DWREngine._warningHandler("Missing callback function or metadata object.");
}
return;
}


var random = Math.floor(Math.random() * 10001);
var id = (random + "_" + new Date().getTime()).toString();
var prefix = "c" + DWREngine._batch.map.callCount + "-";
DWREngine._batch.ids.push(id);


if (callData.method != null) {
DWREngine._batch.method = callData.method;
delete callData.method;
}
if (callData.verb != null) {
DWREngine._batch.verb = callData.verb;
delete callData.verb;
}
if (callData.async != null) {
DWREngine._batch.async = callData.async;
delete callData.async;
}
if (callData.timeout != null) {
DWREngine._batch.timeout = callData.timeout;
delete callData.timeout;
}


if (callData.preHook != null) {
DWREngine._batch.preHooks.unshift(callData.preHook);
delete callData.preHook;
}
if (callData.postHook != null) {
DWREngine._batch.postHooks.push(callData.postHook);
delete callData.postHook;
}


if (callData.errorHandler == null) callData.errorHandler = DWREngine._errorHandler;
if (callData.warningHandler == null) callData.warningHandler = DWREngine._warningHandler;


DWREngine._handlersMap[id] = callData;

DWREngine._batch.map[prefix + "scriptName"] = scriptName;
DWREngine._batch.map[prefix + "methodName"] = methodName;
DWREngine._batch.map[prefix + "id"] = id;


DWREngine._addSerializeFunctions();
for (i = 0; i < params.length; i++) {
DWREngine._serializeAll(DWREngine._batch, [], params[i], prefix + "param" + i);
}
DWREngine._removeSerializeFunctions();


DWREngine._batch.map.callCount++;
if (singleShot) {
DWREngine.endBatch();
}
};




DWREngine._sendData = function(batch) {

if (batch.map.callCount == 0) return;

for (var i = 0; i < batch.preHooks.length; i++) {
batch.preHooks[i]();
}
batch.preHooks = null;

if (batch.timeout && batch.timeout != 0) {
batch.interval = setInterval(function() {
clearInterval(batch.interval);
DWREngine._abortRequest(batch);
}, batch.timeout);
}

var statsInfo;
if (batch.map.callCount == 1) {
statsInfo = batch.map["c0-scriptName"] + "." + batch.map["c0-methodName"] + ".dwr";
}
else {
statsInfo = "Multiple." + batch.map.callCount + ".dwr";
}


if (batch.method == DWREngine.XMLHttpRequest) {
if (window.XMLHttpRequest) {
batch.req = new XMLHttpRequest();
}

else if (window.ActiveXObject && !(navigator.userAgent.indexOf('Mac') >= 0 && navigator.userAgent.indexOf("MSIE") >= 0)) {
batch.req = DWREngine._newActiveXObject(DWREngine._XMLHTTP);
}
}

var query = "";
var prop;
if (batch.req) {
batch.map.xml = "true";

if (batch.async) {
batch.req.onreadystatechange = function() {
DWREngine._stateChange(batch);
};
}

var indexSafari = navigator.userAgent.indexOf('Safari/');
if (indexSafari >= 0) {

var version = navigator.userAgent.substring(indexSafari + 7);
var verNum = parseInt(version, 10);
if (verNum < 400) {
batch.verb == "GET";
}



}
if (batch.verb == "GET") {



batch.map.callCount = "" + batch.map.callCount;

for (prop in batch.map) {
var qkey = encodeURIComponent(prop);
var qval = encodeURIComponent(batch.map[prop]);
if (qval == "") {
if (DWREngine._warningHandler) {
DWREngine._warningHandler("Found empty qval for qkey=" + qkey);
}
}
query += qkey + "=" + qval + "&";
}
query = query.substring(0, query.length - 1);

try {
batch.req.open("GET", batch.path + "/exec/" + statsInfo + "?" + query, batch.async);
batch.req.send(null);
if (!batch.async) {
DWREngine._stateChange(batch);
}
}
catch (ex) {
DWREngine._handleMetaDataError(null, ex);
}
}
else {
for (prop in batch.map) {
if (typeof batch.map[prop] != "function") {
query += prop + "=" + batch.map[prop] + "\n";
}
}

try {




batch.req.open("POST", batch.path + "/exec/" + statsInfo, batch.async);
batch.req.setRequestHeader('Content-Type', 'text/plain');
batch.req.send(query);
if (!batch.async) {
DWREngine._stateChange(batch);
}
}
catch (ex) {
DWREngine._handleMetaDataError(null, ex);
}
}
}
else {
batch.map.xml = "false";
var idname = "dwr-if-" + batch.map["c0-id"];

batch.div = document.createElement('div');
batch.div.innerHTML = "<iframe frameborder='0' width='0' height='0' id='" + idname + "' name='" + idname + "'></iframe>";
document.body.appendChild(batch.div);
batch.iframe = document.getElementById(idname);
batch.iframe.setAttribute('style', 'width:0px; height:0px; border:0px;');

if (batch.verb == "GET") {
for (prop in batch.map) {
if (typeof batch.map[prop] != "function") {
query += encodeURIComponent(prop) + "=" + encodeURIComponent(batch.map[prop]) + "&";
}
}
query = query.substring(0, query.length - 1);

batch.iframe.setAttribute('src', batch.path + "/exec/" + statsInfo + "?" + query);
document.body.appendChild(batch.iframe);
}
else {
batch.form = document.createElement('form');
batch.form.setAttribute('id', 'dwr-form');
batch.form.setAttribute('action', batch.path + "/exec" + statsInfo);
batch.form.setAttribute('target', idname);
batch.form.target = idname;
batch.form.setAttribute('method', 'post');
for (prop in batch.map) {
var formInput = document.createElement('input');
formInput.setAttribute('type', 'hidden');
formInput.setAttribute('name', prop);
formInput.setAttribute('value', batch.map[prop]);
batch.form.appendChild(formInput);
}

document.body.appendChild(batch.form);
batch.form.submit();
}
}
};




DWREngine._stateChange = function(batch) {
if (!batch.completed && batch.req.readyState == 4) {
try {
var reply = batch.req.responseText;
var status = batch.req.status;

if (reply == null || reply == "") {
DWREngine._handleMetaDataError(null, "No data received from server");
return;
}


if (reply.search("DWREngine._handle") == -1) {
DWREngine._handleMetaDataError(null, "Invalid reply from server");
return;
}

if (status != 200) {
if (reply == null) reply = "Unknown error occured";
DWREngine._handleMetaDataError(null, reply);
return;
}

eval(reply);


DWREngine._clearUp(batch);
}
catch (ex) {
if (ex == null) ex = "Unknown error occured";
DWREngine._handleMetaDataError(null, ex);
}
finally {



if (DWREngine._batchQueue.length != 0) {
var sendbatch = DWREngine._batchQueue.shift();
DWREngine._sendData(sendbatch);
DWREngine._batches[DWREngine._batches.length] = sendbatch;
}
}
}
};






DWREngine._handleResponse = function(id, reply) {

var handlers = DWREngine._handlersMap[id];
DWREngine._handlersMap[id] = null;

if (handlers) {


try {
if (handlers.callback) handlers.callback(reply);
}
catch (ex) {
DWREngine._handleMetaDataError(handlers, ex);
}
}


if (DWREngine._method == DWREngine.IFrame) {
var responseBatch = DWREngine._batches[DWREngine._batches.length-1];

if (responseBatch.map["c"+(responseBatch.map.callCount-1)+"-id"] == id) {
DWREngine._clearUp(responseBatch);
}
}
};




DWREngine._handleServerError = function(id, error) {

var handlers = DWREngine._handlersMap[id];
DWREngine._handlersMap[id] = null;
if (error.message) {
DWREngine._handleMetaDataError(handlers, error.message, error);
}
else {
DWREngine._handleMetaDataError(handlers, error);
}
};




DWREngine._abortRequest = function(batch) {
if (batch && batch.metadata != null && !batch.completed) {
DWREngine._clearUp(batch);
if (batch.req) batch.req.abort();

var handlers;
var id;
for (var i = 0; i < batch.ids.length; i++) {
id = batch.ids[i];
handlers = DWREngine._handlersMap[id];
DWREngine._handleMetaDataError(handlers, "Timeout");
}
}
};




DWREngine._clearUp = function(batch) {
if (batch.completed) {
alert("double complete");
return;
}


if (batch.div) batch.div.parentNode.removeChild(batch.div);
if (batch.iframe) batch.iframe.parentNode.removeChild(batch.iframe);
if (batch.form) batch.form.parentNode.removeChild(batch.form);


if (batch.req) delete batch.req;

for (var i = 0; i < batch.postHooks.length; i++) {
batch.postHooks[i]();
}
batch.postHooks = null;


for (var i = 0; i < DWREngine._batches.length; i++) {
if (DWREngine._batches[i] == batch) {
DWREngine._batches.splice(i, 1);
break;
}
}

batch.completed = true;
};




DWREngine._handleError = function(reason, ex) {
if (DWREngine._errorHandler) {
DWREngine._errorHandler(reason, ex);
}
};




DWREngine._handleMetaDataError = function(handlers, reason, ex) {
if (handlers && typeof handlers.errorHandler == "function") {
handlers.errorHandler(reason, ex);
}
else {
DWREngine._handleError(reason, ex);
}
};




DWREngine._addSerializeFunctions = function() {
Object.prototype.dwrSerialize = DWREngine._serializeObject;
Array.prototype.dwrSerialize = DWREngine._serializeArray;
Boolean.prototype.dwrSerialize = DWREngine._serializeBoolean;
Number.prototype.dwrSerialize = DWREngine._serializeNumber;
String.prototype.dwrSerialize = DWREngine._serializeString;
Date.prototype.dwrSerialize = DWREngine._serializeDate;
};




DWREngine._removeSerializeFunctions = function() {
delete Object.prototype.dwrSerialize;
delete Array.prototype.dwrSerialize;
delete Boolean.prototype.dwrSerialize;
delete Number.prototype.dwrSerialize;
delete String.prototype.dwrSerialize;
delete Date.prototype.dwrSerialize;
};








DWREngine._serializeAll = function(batch, referto, data, name) {
if (data == null) {
batch.map[name] = "null:null";
return;
}

switch (typeof data) {
case "boolean":
batch.map[name] = "boolean:" + data;
break;

case "number":
batch.map[name] = "number:" + data;
break;

case "string":
batch.map[name] = "string:" + encodeURIComponent(data);
break;

case "object":
if (data.dwrSerialize) {
batch.map[name] = data.dwrSerialize(batch, referto, data, name);
}
else if (data.nodeName) {
batch.map[name] = DWREngine._serializeXml(batch, referto, data, name);
}
else {
if (DWREngine._warningHandler) {
DWREngine._warningHandler("Object without dwrSerialize: " + typeof data + ", attempting default converter.");
}
batch.map[name] = "default:" + data;
}
break;

case "function":

break;

default:
if (DWREngine._warningHandler) {
DWREngine._warningHandler("Unexpected type: " + typeof data + ", attempting default converter.");
}
batch.map[name] = "default:" + data;
break;
}
};


DWREngine._lookup = function(referto, data, name) {
var lookup;

for (var i = 0; i < referto.length; i++) {
if (referto[i].data == data) {
lookup = referto[i];
break;
}
}
if (lookup) {
return "reference:" + lookup.name;
}
referto.push({ data:data, name:name });
return null;
};


DWREngine._serializeObject = function(batch, referto, data, name) {
var ref = DWREngine._lookup(referto, this, name);
if (ref) return ref;

if (data.nodeName) {
return DWREngine._serializeXml(batch, referto, data, name);
}


var reply = "Object:{";
var element;
for (element in this)  {
if (element != "dwrSerialize") {
batch.paramCount++;
var childName = "c" + DWREngine._batch.map.callCount + "-e" + batch.paramCount;
DWREngine._serializeAll(batch, referto, this[element], childName);

reply += encodeURIComponent(element);
reply += ":reference:";
reply += childName;
reply += ", ";
}
}

if (reply.substring(reply.length - 2) == ", ") {
reply = reply.substring(0, reply.length - 2);
}
reply += "}";

return reply;
};


DWREngine._serializeXml = function(batch, referto, data, name) {
var ref = DWREngine._lookup(referto, this, name);
if (ref) {
return ref;
}
var output;
if (window.XMLSerializer) {
var serializer = new XMLSerializer();
output = serializer.serializeToString(data);
}
else {
output = data.toXml;
}
return "XML:" + encodeURIComponent(output);
};


DWREngine._serializeArray = function(batch, referto, data, name) {
var ref = DWREngine._lookup(referto, this, name);
if (ref) return ref;

var reply = "Array:[";
for (var i = 0; i < this.length; i++) {
if (i != 0) {
reply += ",";
}

batch.paramCount++;
var childName = "c" + DWREngine._batch.map.callCount + "-e" + batch.paramCount;
DWREngine._serializeAll(batch, referto, this[i], childName);
reply += "reference:";
reply += childName;
}
reply += "]";

return reply;
};


DWREngine._serializeBoolean = function(batch, referto, data, name) {
return "Boolean:" + this;
};


DWREngine._serializeNumber = function(batch, referto, data, name) {
return "Number:" + this;
};


DWREngine._serializeString = function(batch, referto, data, name) {
return "String:" + encodeURIComponent(this);
};


DWREngine._serializeDate = function(batch, referto, data, name) {
return "Date:" + this.getTime();
};


DWREngine._unserializeDocument = function(xml) {
var dom;
if (window.DOMParser) {
var parser = new DOMParser();
dom = parser.parseFromString(xml, "text/xml");
if (!dom.documentElement || dom.documentElement.tagName == "parsererror") {
var message = dom.documentElement.firstChild.data;
message += "\n" + dom.documentElement.firstChild.nextSibling.firstChild.data;
throw message;
}
return dom;
}
else if (window.ActiveXObject) {
dom = DWREngine._newActiveXObject(DWREngine._DOMDocument);
dom.loadXML(xml);

return dom;
}








else {
var div = document.createElement('div');
div.innerHTML = xml;
return div;
}
};





DWREngine._newActiveXObject = function(axarray) {
var returnValue;
for (var i = 0; i < axarray.length; i++) {
try {
returnValue = new ActiveXObject(axarray[i]);
break;
}
catch (ex) {
}
}
return returnValue;
};


if (typeof window.encodeURIComponent === 'undefined') {
DWREngine._utf8 = function(wide) {
wide = "" + wide;
var c;
var s;
var enc = "";
var i = 0;
while (i < wide.length) {
c = wide.charCodeAt(i++);

if (c >= 0xDC00 && c < 0xE000) continue;
if (c >= 0xD800 && c < 0xDC00) {
if (i >= wide.length) continue;
s = wide.charCodeAt(i++);
if (s < 0xDC00 || c >= 0xDE00) continue;
c = ((c - 0xD800) << 10) + (s - 0xDC00) + 0x10000;
}

if (c < 0x80) {
enc += String.fromCharCode(c);
}
else if (c < 0x800) {
enc += String.fromCharCode(0xC0 + (c >> 6), 0x80 + (c & 0x3F));
}
else if (c < 0x10000) {
enc += String.fromCharCode(0xE0 + (c >> 12), 0x80 + (c >> 6 & 0x3F), 0x80 + (c & 0x3F));
}
else {
enc += String.fromCharCode(0xF0 + (c >> 18), 0x80 + (c >> 12 & 0x3F), 0x80 + (c >> 6 & 0x3F), 0x80 + (c & 0x3F));
}
}
return enc;
}

DWREngine._hexchars = "0123456789ABCDEF";

DWREngine._toHex = function(n) {
return DWREngine._hexchars.charAt(n >> 4) + DWREngine._hexchars.charAt(n & 0xF);
}

DWREngine._okURIchars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789_-";

window.encodeURIComponent = function(s)  {
s = DWREngine._utf8(s);
var c;
var enc = "";
for (var i= 0; i<s.length; i++) {
if (DWREngine._okURIchars.indexOf(s.charAt(i)) == -1) {
enc += "%" + DWREngine._toHex(s.charCodeAt(i));
}
else {
enc += s.charAt(i);
}
}
return enc;
}
}


if (typeof Array.prototype.splice === 'undefined') {
Array.prototype.splice = function(ind, cnt)
{
if (arguments.length == 0) {
return ind;
}
if (typeof ind != "number") {
ind = 0;
}
if (ind < 0) {
ind = Math.max(0,this.length + ind);
}
if (ind > this.length) {
if (arguments.length > 2) {
ind = this.length;
}
else {
return [];
}
}
if (arguments.length < 2) {
cnt = this.length-ind;
}

cnt = (typeof cnt == "number") ? Math.max(0, cnt) : 0;
removeArray = this.slice(ind, ind + cnt);
endArray = this.slice(ind + cnt);
this.length = ind;

for (var i = 2; i < arguments.length; i++) {
this[this.length] = arguments[i];
}
for (i = 0; i < endArray.length; i++) {
this[this.length] = endArray[i];
}

return removeArray;
}
}


if (typeof Array.prototype.shift === 'undefined') {
Array.prototype.shift = function(str) {
var val = this[0];
for (var i = 1; i < this.length; ++i) {
this[i - 1] = this[i];
}
this.length--;
return val;
}
}


if (typeof Array.prototype.unshift === 'undefined') {
Array.prototype.unshift = function() {
var i = unshift.arguments.length;
for (var j = this.length - 1; j >= 0; --j) {
this[j + i] = this[j];
}
for (j = 0; j < i; ++j) {
this[j] = unshift.arguments[j];
}
}
}


if (typeof Array.prototype.push === 'undefined') {
Array.prototype.push = function() {
var sub = this.length;
for (var i = 0; i < push.arguments.length; ++i) {
this[sub] = push.arguments[i];
sub++;
}
}
}


if (typeof Array.prototype.pop === 'undefined') {
Array.prototype.pop = function() {
var lastElement = this[this.length - 1];
this.length--;
return lastElement;
}
}


function RendererPreviewAjaxUtil() { }
RendererPreviewAjaxUtil._path = '/issues/dwr';

RendererPreviewAjaxUtil.getPreviewHtml = function(p0, p1, p2, callback) {
    DWREngine._execute(RendererPreviewAjaxUtil._path, 'RendererPreviewAjaxUtil', 'getPreviewHtml', p0, p1, p2, callback);
}




















function DWRUtil() { }





DWRUtil.onReturn = function(event, action) {
if (!event) {
event = window.event;
}
if (event && event.keyCode && event.keyCode == 13) {
action();
}
};





DWRUtil.selectRange = function(ele, start, end) {
var orig = ele;
ele = $(ele);
if (ele == null) {
DWRUtil.debug("selectRange() can't find an element with id: " + orig + ".");
return;
}
if (ele.setSelectionRange) {
ele.setSelectionRange(start, end);
}
else if (ele.createTextRange) {
var range = ele.createTextRange();
range.moveStart("character", start);
range.moveEnd("character", end - ele.value.length);
range.select();
}
ele.focus();
};





var $;
if (!$ && document.getElementById) {
$ = function() {
var elements = new Array();
for (var i = 0; i < arguments.length; i++) {
var element = arguments[i];
if (typeof element == 'string') {
element = document.getElementById(element);
}
if (arguments.length == 1) {
return element;
}
elements.push(element);
}
return elements;
}
}
else if (!$ && document.all) {
$ = function() {
var elements = new Array();
for (var i = 0; i < arguments.length; i++) {
var element = arguments[i];
if (typeof element == 'string') {
element = document.all[element];
}
if (arguments.length == 1) {
return element;
}
elements.push(element);
}
return elements;
}
}





DWRUtil.toDescriptiveString = function(data, level, depth) {
var reply = "";
var i = 0;
var value;
var obj;
if (level == null) level = 0;
if (depth == null) depth = 0;
if (data == null) return "null";
if (DWRUtil._isArray(data)) {
if (data.length == 0) reply += "[]";
else {
if (level != 0) reply += "[\n";
else reply = "[";
for (i = 0; i < data.length; i++) {
try {
obj = data[i];
if (obj == null || typeof obj == "function") {
continue;
}
else if (typeof obj == "object") {
if (level > 0) value = DWRUtil.toDescriptiveString(obj, level - 1, depth + 1);
else value = DWRUtil._detailedTypeOf(obj);
}
else {
value = "" + obj;
value = value.replace(/\/n/g, "\\n");
value = value.replace(/\/t/g, "\\t");
}
}
catch (ex) {
value = "" + ex;
}
if (level != 0)  {
reply += DWRUtil._indent(level, depth + 2) + value + ", \n";
}
else {
if (value.length > 13) value = value.substring(0, 10) + "...";
reply += value + ", ";
if (i > 5) {
reply += "...";
break;
}
}
}
if (level != 0) reply += DWRUtil._indent(level, depth) + "]";
else reply += "]";
}
return reply;
}
if (typeof data == "string" || typeof data == "number" || DWRUtil._isDate(data)) {
return data.toString();
}
if (typeof data == "object") {
var typename = DWRUtil._detailedTypeOf(data);
if (typename != "Object")  reply = typename + " ";
if (level != 0) reply += "{\n";
else reply = "{";
var isHtml = DWRUtil._isHTMLElement(data);
for (var prop in data) {
if (isHtml) {

if (prop.toUpperCase() == prop || prop == "title" ||
prop == "lang" || prop == "dir" || prop == "className" ||
prop == "form" || prop == "name" || prop == "prefix" ||
prop == "namespaceURI" || prop == "nodeType" ||
prop == "firstChild" || prop == "lastChild" ||
prop.match(/^offset/)) {
continue;
}
}
value = "";
try {
obj = data[prop];
if (obj == null || typeof obj == "function") {
continue;
}
else if (typeof obj == "object") {
if (level > 0) {
value = "\n";
value += DWRUtil._indent(level, depth + 2);
value = DWRUtil.toDescriptiveString(obj, level - 1, depth + 1);
}
else {
value = DWRUtil._detailedTypeOf(obj);
}
}
else {
value = "" + obj;
value = value.replace(/\/n/g, "\\n");
value = value.replace(/\/t/g, "\\t");
}
}
catch (ex) {
value = "" + ex;
}
if (level == 0 && value.length > 13) value = value.substring(0, 10) + "...";
var propStr = prop;
if (propStr.length > 30) propStr = propStr.substring(0, 27) + "...";
if (level != 0) reply += DWRUtil._indent(level, depth + 1);
reply += prop + ":" + value + ", ";
if (level != 0) reply += "\n";
i++;
if (level == 0 && i > 5) {
reply += "...";
break;
}
}
reply += DWRUtil._indent(level, depth);
reply += "}";
return reply;
}
return data.toString();
};




DWRUtil._indent = function(level, depth) {
var reply = "";
if (level != 0) {
for (var j = 0; j < depth; j++) {
reply += "\u00A0\u00A0";
}
reply += " ";
}
return reply;
};





DWRUtil.useLoadingMessage = function(message) {
var loadingMessage;
if (message) loadingMessage = message;
else loadingMessage = "Loading";
DWREngine.setPreHook(function() {
var disabledZone = $('disabledZone');
if (!disabledZone) {
disabledZone = document.createElement('div');
disabledZone.setAttribute('id', 'disabledZone');
disabledZone.style.position = "absolute";
disabledZone.style.zIndex = "1000";
disabledZone.style.left = "0px";
disabledZone.style.top = "0px";
disabledZone.style.width = "100%";
disabledZone.style.height = "100%";
document.body.appendChild(disabledZone);
var messageZone = document.createElement('div');
messageZone.setAttribute('id', 'messageZone');
messageZone.style.position = "absolute";
messageZone.style.top = "0px";
messageZone.style.right = "0px";
messageZone.style.background = "red";
messageZone.style.color = "white";
messageZone.style.fontFamily = "Arial,Helvetica,sans-serif";
messageZone.style.padding = "4px";
disabledZone.appendChild(messageZone);
var text = document.createTextNode(loadingMessage);
messageZone.appendChild(text);
}
else {
$('messageZone').innerHTML = loadingMessage;
disabledZone.style.visibility = 'visible';
}
});
DWREngine.setPostHook(function() {
$('disabledZone').style.visibility = 'hidden';
});
}





DWRUtil.setValue = function(ele, val) {
if (val == null) val = "";

var orig = ele;
var nodes, i;

ele = $(ele);

if (ele == null) {
nodes = document.getElementsByName(orig);
if (nodes.length >= 1) {
ele = nodes.item(0);
}
}
if (ele == null) {
DWRUtil.debug("setValue() can't find an element with id/name: " + orig + ".");
return;
}

if (DWRUtil._isHTMLElement(ele, "select")) {
if (ele.type == "select-multiple" && DWRUtil._isArray(val)) {
DWRUtil._selectListItems(ele, val);
}
else {
DWRUtil._selectListItem(ele, val);
}
return;
}

if (DWRUtil._isHTMLElement(ele, "input")) {
if (nodes && ele.type == "radio") {
for (i = 0; i < nodes.length; i++) {
if (nodes.item(i).type == "radio") {
nodes.item(i).checked = (nodes.item(i).value == val);
}
}
}
else {
switch (ele.type) {
case "checkbox":
case "check-box":
case "radio":
ele.checked = (val == true);
return;
default:
ele.value = val;
return;
}
}
}

if (DWRUtil._isHTMLElement(ele, "textarea")) {
ele.value = val;
return;
}



if (val.nodeType) {
if (val.nodeType == 9  ) {
val = val.documentElement;
}

val = DWRUtil._importNode(ele.ownerDocument, val, true);
ele.appendChild(val);
return;
}


ele.innerHTML = val;
};






DWRUtil._selectListItems = function(ele, val) {


var found  = false;
var i;
var j;
for (i = 0; i < ele.options.length; i++) {
ele.options[i].selected = false;
for (j = 0; j < val.length; j++) {
if (ele.options[i].value == val[j]) {
ele.options[i].selected = true;
}
}
}

if (found) return;

for (i = 0; i < ele.options.length; i++) {
for (j = 0; j < val.length; j++) {
if (ele.options[i].text == val[j]) {
ele.options[i].selected = true;
}
}
}
};






DWRUtil._selectListItem = function(ele, val) {


var found  = false;
var i;
for (i = 0; i < ele.options.length; i++) {
if (ele.options[i].value == val) {
ele.options[i].selected = true;
found = true;
}
else {
ele.options[i].selected = false;
}
}


if (found) return;

for (i = 0; i < ele.options.length; i++) {
if (ele.options[i].text == val) {
ele.options[i].selected = true;
break;
}
}
}





DWRUtil.getValue = function(ele) {
var orig = ele;
ele = $(ele);


var nodes = document.getElementsByName(orig);
if (ele == null && nodes.length >= 1) {
ele = nodes.item(0);
}
if (ele == null) {
DWRUtil.debug("getValue() can't find an element with id/name: " + orig + ".");
return "";
}

if (DWRUtil._isHTMLElement(ele, "select")) {


var sel = ele.selectedIndex;
if (sel != -1) {
var reply = ele.options[sel].value;
if (reply == null || reply == "") {
reply = ele.options[sel].text;
}

return reply;
}
else {
return "";
}
}

if (DWRUtil._isHTMLElement(ele, "input")) {
if (nodes && ele.type == "radio") {
for (i = 0; i < nodes.length; i++) {
if (nodes.item(i).type == "radio") {
if (nodes.item(i).checked) {
return nodes.item(i).value;
}
}
}
}
switch (ele.type) {
case "checkbox":
case "check-box":
case "radio":
return ele.checked;
default:
return ele.value;
}
}

if (DWRUtil._isHTMLElement(ele, "textarea")) {
return ele.value;
}

if (ele.textContent) return ele.textContent;
else if (ele.innerText) return ele.innerText;
return ele.innerHTML;
};





DWRUtil.getText = function(ele) {
var orig = ele;
ele = $(ele);
if (ele == null) {
DWRUtil.debug("getText() can't find an element with id: " + orig + ".");
return "";
}

if (!DWRUtil._isHTMLElement(ele, "select")) {
DWRUtil.debug("getText() can only be used with select elements. Attempt to use: " + DWRUtil._detailedTypeOf(ele) + " from  id: " + orig + ".");
return "";
}



var sel = ele.selectedIndex;
if (sel != -1) {
return ele.options[sel].text;
}
else {
return "";
}
};





DWRUtil.setValues = function(map) {
for (var property in map) {
var ele = $(property);
if (ele != null) {
var value = map[property];
DWRUtil.setValue(property, value);
}
}
};






DWRUtil.getValues = function(data) {
var ele;
if (typeof data == "string") ele = $(data);
if (DWRUtil._isHTMLElement(data)) ele = data;
if (ele != null) {
if (ele.elements == null) {
alert("getValues() requires an object or reference to a form element.");
return null;
}
var reply = {};
var value;
for (var i = 0; i < ele.elements.length; i++) {
if (ele[i].id != null) value = ele[i].id;
else if (ele[i].value != null) value = ele[i].value;
else value = "element" + i;
reply[value] = DWRUtil.getValue(ele[i]);
}
return reply;
}
else {
for (var property in data) {
var ele = $(property);
if (ele != null) {
data[property] = DWRUtil.getValue(property);
}
}
return data;
}
};





DWRUtil.addOptions = function(ele, data) {
var orig = ele;
ele = $(ele);
if (ele == null) {
DWRUtil.debug("addOptions() can't find an element with id: " + orig + ".");
return;
}
var useOptions = DWRUtil._isHTMLElement(ele, "select");
var useLi = DWRUtil._isHTMLElement(ele, ["ul", "ol"]);
if (!useOptions && !useLi) {
DWRUtil.debug("addOptions() can only be used with select/ul/ol elements. Attempt to use: " + DWRUtil._detailedTypeOf(ele));
return;
}
if (data == null) return;

var text;
var value;
var opt;
var li;
if (DWRUtil._isArray(data)) {

for (var i = 0; i < data.length; i++) {
if (useOptions) {
if (arguments[2] != null) {
if (arguments[3] != null) {
text = DWRUtil._getValueFrom(data[i], arguments[3]);
value = DWRUtil._getValueFrom(data[i], arguments[2]);
}
else {
value = DWRUtil._getValueFrom(data[i], arguments[2]);
text = value;
}
}
else
{
text = DWRUtil._getValueFrom(data[i], arguments[3]);
value = text;
}
if (text || value) {
opt = new Option(text, value);
ele.options[ele.options.length] = opt;
}
}
else {
li = document.createElement("li");
value = DWRUtil._getValueFrom(data[i], arguments[2]);
if (value != null) {
li.innerHTML = value;
ele.appendChild(li);
}
}
}
}
else if (arguments[3] != null) {
for (var prop in data) {
if (!useOptions) {
alert("DWRUtil.addOptions can only create select lists from objects.");
return;
}
value = DWRUtil._getValueFrom(data[prop], arguments[2]);
text = DWRUtil._getValueFrom(data[prop], arguments[3]);
if (text || value) {
opt = new Option(text, value);
ele.options[ele.options.length] = opt;
}
}
}
else {
for (var prop in data) {
if (!useOptions) {
DWRUtil.debug("DWRUtil.addOptions can only create select lists from objects.");
return;
}
if (typeof data[prop] == "function") {

text = null;
value = null;
}
else if (arguments[2]) {
text = prop;
value = data[prop];
}
else {
text = data[prop];
value = prop;
}
if (text || value) {
opt = new Option(text, value);
ele.options[ele.options.length] = opt;
}
}
}
};




DWRUtil._getValueFrom = function(data, method) {
if (method == null) return data;
else if (typeof method == 'function') return method(data);
else return data[method];
}





DWRUtil.removeAllOptions = function(ele) {
var orig = ele;
ele = $(ele);
if (ele == null) {
DWRUtil.debug("removeAllOptions() can't find an element with id: " + orig + ".");
return;
}
var useOptions = DWRUtil._isHTMLElement(ele, "select");
var useLi = DWRUtil._isHTMLElement(ele, ["ul", "ol"]);
if (!useOptions && !useLi) {
DWRUtil.debug("removeAllOptions() can only be used with select, ol and ul elements. Attempt to use: " + DWRUtil._detailedTypeOf(ele));
return;
}
if (useOptions) {
ele.options.length = 0;
}
else {
while (ele.childNodes.length > 0) {
ele.removeChild(ele.firstChild);
}
}
};





DWRUtil.addRows = function(ele, data, cellFuncs, options) {
var orig = ele;
ele = $(ele);
if (ele == null) {
DWRUtil.debug("addRows() can't find an element with id: " + orig + ".");
return;
}
if (!DWRUtil._isHTMLElement(ele, ["table", "tbody", "thead", "tfoot"])) {
DWRUtil.debug("addRows() can only be used with table, tbody, thead and tfoot elements. Attempt to use: " + DWRUtil._detailedTypeOf(ele));
return;
}
if (!options) options = {};
if (!options.rowCreator) options.rowCreator = DWRUtil._defaultRowCreator;
if (!options.cellCreator) options.cellCreator = DWRUtil._defaultCellCreator;
var tr, rowNum;
if (DWRUtil._isArray(data)) {
for (rowNum = 0; rowNum < data.length; rowNum++) {
options.rowData = data[rowNum];
options.rowIndex = rowNum;
options.rowNum = rowNum;
options.data = null;
options.cellNum = -1;
tr = DWRUtil._addRowInner(cellFuncs, options);
if (tr != null) ele.appendChild(tr);
}
}
else if (typeof data == "object") {
rowNum = 0;
for (var rowIndex in data) {
options.rowData = data[rowIndex];
options.rowIndex = rowIndex;
options.rowNum = rowNum;
options.data = null;
options.cellNum = -1;
tr = DWRUtil._addRowInner(cellFuncs, options);
if (tr != null) ele.appendChild(tr);
rowNum++;
}
}
};




DWRUtil._addRowInner = function(cellFuncs, options) {
var tr = options.rowCreator(options);
if (tr == null) return null;
for (var cellNum = 0; cellNum < cellFuncs.length; cellNum++) {
var func = cellFuncs[cellNum];
var td;







var reply = func(options.rowData);
options.data = reply;
options.cellNum = cellNum;
td = options.cellCreator(options);
if (DWRUtil._isHTMLElement(reply, "td")) td = reply;
else if (DWRUtil._isHTMLElement(reply)) td.appendChild(reply);
else td.innerHTML = reply;

tr.appendChild(td);
}
return tr;
};




DWRUtil._defaultRowCreator = function(options) {
return document.createElement("tr");
};




DWRUtil._defaultCellCreator = function(options) {
return document.createElement("td");
};





DWRUtil.removeAllRows = function(ele) {
var orig = ele;
ele = $(ele);
if (ele == null) {
DWRUtil.debug("removeAllRows() can't find an element with id: " + orig + ".");
return;
}
if (!DWRUtil._isHTMLElement(ele, ["table", "tbody", "thead", "tfoot"])) {
DWRUtil.debug("removeAllRows() can only be used with table, tbody, thead and tfoot elements. Attempt to use: " + DWRUtil._detailedTypeOf(ele));
return;
}
while (ele.childNodes.length > 0) {
ele.removeChild(ele.firstChild);
}
};







DWRUtil._isHTMLElement = function(ele, nodeName) {
if (ele == null || typeof ele != "object" || ele.nodeName == null) {
return false;
}

if (nodeName != null) {
var test = ele.nodeName.toLowerCase();

if (typeof nodeName == "string") {
return test == nodeName.toLowerCase();
}

if (DWRUtil._isArray(nodeName)) {
var match = false;
for (var i = 0; i < nodeName.length && !match; i++) {
if (test == nodeName[i].toLowerCase()) {
match =  true;
}
}
return match;
}

DWRUtil.debug("DWRUtil._isHTMLElement was passed test node name that is neither a string or array of strings");
return false;
}

return true;
};




DWRUtil._detailedTypeOf = function(x) {
var reply = typeof x;
if (reply == "object") {
reply = Object.prototype.toString.apply(x);
reply = reply.substring(8, reply.length-1);
}
return reply;
};




DWRUtil._isArray = function(data) {
return (data && data.join) ? true : false;
};




DWRUtil._isDate = function(data) {
return (data && data.toUTCString) ? true : false;
};




DWRUtil._importNode = function(doc, importedNode, deep) {
var newNode;

if (importedNode.nodeType == 1  ) {
newNode = doc.createElement(importedNode.nodeName);

for (var i = 0; i < importedNode.attributes.length; i++) {
var attr = importedNode.attributes[i];
if (attr.nodeValue != null && attr.nodeValue != '') {
newNode.setAttribute(attr.name, attr.nodeValue);
}
}

if (typeof importedNode.style != "undefined") {
newNode.style.cssText = importedNode.style.cssText;
}
}
else if (importedNode.nodeType == 3  ) {
newNode = doc.createTextNode(importedNode.nodeValue);
}

if (deep && importedNode.hasChildNodes()) {
for (i = 0; i < importedNode.childNodes.length; i++) {
newNode.appendChild(DWRUtil._importNode(doc, importedNode.childNodes[i], true));
}
}

return newNode;
}




DWRUtil.debug = function(message) {
alert(message);
}

