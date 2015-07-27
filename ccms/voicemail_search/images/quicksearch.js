// Todo - this uses global variables, we could really rewrite it to use objects.
var calledReallyShow = false;
var calledReallyHide = false;
var mouseOnText = false;
var mouseInTip = false;

function showToolTip()
{
    mouseOnText = true;
    mouseInTip = false;
    if (!calledReallyShow)
    {
        calledReallyShow = true;
        self.setTimeout("reallyShowTip()", 800);
    }
}

function recordInTip()
{
    mouseInTip = true;
    mouseOnText = false;
}

function recordOutTip()
{
    mouseInTip = false;
    fireReallyHide();
}

function reallyShowTip()
{
    calledReallyShow = false;
    if (mouseOnText)
    {
        document.getElementById('quicksearchhelp').style.display = '';
        document.getElementById('quicksearchhelp').style.top = findPosY(document.getElementById('quickSearchInput')) + 25;
    }
}

function hideToolTip()
{
    mouseOnText = false;
    fireReallyHide();
}

function fireReallyHide()
{
    if (!calledReallyHide)
    {
        calledReallyHide = true;
        self.setTimeout("reallyHideTip()", 800);
    }
}

function reallyHideTip()
{
    calledReallyHide = false;
    if (!mouseInTip)
    {
        document.getElementById('quicksearchhelp').style.display = 'none';
    }
}

function findPosY(obj)
{
    var curtop = 0;
    if (obj.offsetParent)
    {
        while (obj.offsetParent)
        {
            curtop += obj.offsetTop
            obj = obj.offsetParent;
        }
    }
    else if (obj.y)
        curtop += obj.y;
    return curtop;
}