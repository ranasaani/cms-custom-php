function getElements(parent_element, tag_name, class_name, first_only)
{
    var el = null;
    var classes = null;
    var result = new Array();
    var elements = parent_element.getElementsByTagName(tag_name);
    var length = elements.length;
    for (var i = 0; i < length; i++) {
        el = elements.item(i);
        if (undefined != class_name) {
            classes = el.getAttribute('class');
            if (null != classes && classes.indexOf(class_name) > -1) {
                if (undefined != first_only && first_only === true) return el;
                result.push(el);
            }
        } else {
            if (undefined != first_only && first_only === true) return el;
            result.push(el);
        }
    }
    return (undefined != first_only && first_only === true) ? false : (result.length > 0 ? result : false);
}

function setDisplay(elements, display)
{
    for (index in elements) elements[index].style.display = display;
}

function close_all(ignore)
{
    if (!(
        ignore.indexOf('zdc-records') > -1 ||
        ignore.indexOf('zdc-explain') > -1 ||
        ignore.indexOf('zdc-backtrace') > -1
    )) {
        var block = null;
        var blocks = new Array();
        blocks = ['zdc-errors', 'zdc-successful-queries', 'zdc-unsuccessful-queries'];
        for (index in blocks) {
            block = blocks[index];
            if (block != ignore) {
                el = document.getElementById(block);
                if (null != el) {
                    children = getElements(el, 'table', 'zdc-entry');
                    setDisplay(children, 'none');
                    el.style.display = 'none';
                }
            }
        }
        if (null == ignore.match(/^zdc\-globals/)) {
            document.getElementById('zdc-globals-submenu').style.display = 'none';
            parent_element = document.getElementById('zdc-globals');
            parent_element.style.display = 'none';
            blocks =['post', 'get', 'cookie', 'files', 'server'];
            for (index in blocks) {
                el = 'zdc-globals-' + blocks[index];
                document.getElementById(el).style.display = 'none';
            }
        } else {
            blocks =['post', 'get', 'cookie', 'files', 'server'];
            for (index in blocks) {
                el = 'zdc-globals-' + blocks[index];
                if (el != ignore) document.getElementById(el).style.display = 'none';
            }
        }
    }
}

function zdc_toggle(element)
{
    close_all(element);
    var el = null;
    if (element == 'console') {
        el = document.getElementById('zdc');
        el.style.display = (el.style.display != 'block' ? 'block' : 'none');
    } else {
        var children = null;
        var status = null;
        switch (element) {
            case 'zdc-errors':
            case 'zdc-successful-queries':
            case 'zdc-unsuccessful-queries':
                el = document.getElementById(element);
                if (null != el) {
                    children = getElements(el, 'table', 'zdc-entry');
                    status = (el.style.display != 'block' ? 'block' : 'none');
                    setDisplay(children, status);
                    el.style.display = status;
                }
                break;
            case 'zdc-globals-submenu':
                el = document.getElementById(element);
                el.style.display = (el.style.display != 'block' ? 'block' : 'none');
                parent_element = document.getElementById('zdc-globals');
                parent_element.style.display = (parent_element.style.display != 'block' ? 'block' : 'none');
                break;
            case 'zdc-globals-post':
            case 'zdc-globals-get':
            case 'zdc-globals-cookie':
            case 'zdc-globals-files':
            case 'zdc-globals-server':
                el = document.getElementById(element);
                el.style.display = (el.style.display != 'block' ? 'block' : 'none');
                break;
            default:
                el = document.getElementById(element);
                var matches = element.match(/\-([a-z]+)([0-9]+)$/);
                var elem1 = null,
                    elem2 = null,
                    elem3 = null;
                if (null != matches) {
                    elem1 = document.getElementById('zdc-records-' + matches[1] + matches[2]);
                    elem2 = document.getElementById('zdc-explain-' + matches[1] + matches[2]);
                    elem3 = document.getElementById('zdc-backtrace-' + matches[1] + matches[2]);
                    if (null != elem1 && elem1 != el) elem1.style.display = 'none';
                    if (null != elem2 && elem2 != el) elem2.style.display = 'none';
                    if (null != elem3 && elem3 != el) elem3.style.display = 'none';
                }
                if (null != el) el.style.display = (el.style.display != 'block' ? 'block' : 'none');
        }
    }
}


// /* The DOM-ready part is copyright (c) Patrick Hunlock and is taken from http://www.hunlock.com/blogs/Are_you_ready_for_this */

startStack=function() { };  // A stack of functions to run onload/domready

registerOnLoad = function(func) {
    var orgOnLoad = startStack;
    startStack = function () {
        orgOnLoad();
        func();
        return;
    }
}

var ranOnload=false; // Flag to determine if we've ran the starting stack already.

if (document.addEventListener) {
    // Mozilla actually has a DOM READY event.
    document.addEventListener("DOMContentLoaded", function() {
        if (!ranOnload) {
            ranOnload=true;
            startStack();
        }
    }, false);
} else if (document.all && !window.opera) {
    // This is the IE style which exploits a property of the (standards defined) defer attribute
    document.write("<scr" + "ipt id='DOMReady' defer=true " + "src=//:><\/scr" + "ipt>");
    document.getElementById("DOMReady").onreadystatechange = function() {
        if (this.readyState == "complete" && (!ranOnload)) {
            ranOnload=true;
            startStack();
        }
    }
}

var orgOnLoad = window.onload;
window.onload = function() {
    if (typeof(orgOnLoad)=='function') {
        orgOnLoad();
    }
    if (!ranOnload) {
        ranOnload=true;
        startStack();
    }
}

registerOnLoad(function () {
    // do we have any error messages?
    var errors = document.getElementById('zdc-errors');
    var unsuccessful = document.getElementById('zdc-unsuccessful-queries');
    if (null != errors) {
        children = getElements(errors, 'table', 'zdc-entry');
        setDisplay(children, 'block');
        errors.style.display = 'block';
    // do we have any unsuccessful queries?
    } else if (null != unsuccessful) {
        children = getElements(unsuccessful, 'table', 'zdc-entry');
        setDisplay(children, 'block');
        unsuccessful.style.display = 'block';
    } else {
        var successful = document.getElementById('zdc-successful-queries');
        var highlight = getElements(successful, 'table', 'zdc-highlight');
        setDisplay(highlight, 'block');
        successful.style.display = 'block';
    }
});