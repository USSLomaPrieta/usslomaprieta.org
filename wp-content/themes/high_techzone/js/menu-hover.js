ElementMVar1 = "span"
ElementNewVar = new Element(ElementMVar1);
tt = new Element('div');
mycurrentVar = "current";
myhoverVar = "hover_fun";
mypositionVar = "top";
ElementMVar2 = "navigation";
ElementMVar3 = "li a";
window.addEvent('domready', function() {
	myelementVar = $(ElementMVar2).getElement(ElementMVar3);
	myelementsVar = $(ElementMVar2).getElements(ElementMVar3);
	myelementVar.addClass(mycurrentVar);
	myelementVar.addClass(myhoverVar);
	ElementNewVar.inject(myelementVar, mypositionVar);
	myelementsVar.addEvent('mouseenter', myFunaddspan);
	tt.inject(myelementVar, mypositionVar);
	ttt = myelementVar.getCoordinates();
	ttt_width = ttt.width;
	mydiv_abs_width = $('navigation').getElement('div').getStyle('width').toInt();
	myelementVar.getElement('div').setStyles({
		left: Math.abs((ttt_width - mydiv_abs_width) / 2),
		bottom: '0'
	});
});
var myFunaddspan = function () {
	tt.inject(this, mypositionVar);
	ttt = this.getCoordinates();
	ttt_width = ttt.width;
	this.getElement('div').setStyles({
		left: Math.abs((ttt_width - mydiv_abs_width) / 2),
		bottom: '0'
	});
	ElementNewVar.inject(this, mypositionVar);
	myelementsVar.removeClass(mycurrentVar);
	myelementsVar.removeClass(myhoverVar);
	this.addClass(mycurrentVar);
	this.addClass(myhoverVar);
}