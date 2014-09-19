var url = 'http://drydock.usslomaprieta.org/lp_js/roster.json';
//var roster = [];
//var XMLHttpRequest = require("xmlhttprequest").XMLHttpRequest;

var getCrewRoster = function () {
	console.log('getCrewRoster called!');
	jQuery.getJSON(url, function (roster) {
		console.log(url);
		console.log(roster);
		addCrewToPage(roster.Crew);
		addRunaboutToPage(roster.Runabout);
		addAlumniToPage(roster.Alumni);
	});
}


var addCrewToPage = function(crew) {
	for(var i = 0; i < crew.length; i++) {
		console.log(crew[i]);
		var crewUL = document.getElementById(crew.dept[i] + '_Staff');
		var crewLI = document.createElement('li');
		crewLI.className = 'crew_member';
		var memberIMG = document.createElement('div');
		memberIMG.className = 'crew_img';
		if (crew[i].img == null) {
			memberIMG.innerHTML = '<img src="lp_img/old_site_images/userTest.png">';
		} else {
			memberIMG.innerHTML = '<img src="' + crew[i].img + '">';
		};
		var memberInfo = document.createElement('div');
		memberInfo.className = 'crew_info';
		var memberName = document.createElement('div');
	    memberName.className = 'crew_name';
	    memberName.innerHTML = crew[i].name;
	    var memberRank = document.createElement('div');
	    memberRank.className = 'crew_rank';
	    memberRank.innerHTML = crew[i].rank;
	    var memberDesc = document.createElement('div');
	    memberDesc.className = 'crew_desc';
	    memberDesc.innerHTML = '<p>'+crew[i].desc+'</p>';
	    memberInfo.appendChild(memberName);
	    memberInfo.appendChild(memberRank);
	    memberInfo.appendChild(memberDesc);
	    crewLI.appendChild(memberIMG);
	    crewLI.appendChild(memberInfo);
	}
}

var addRunaboutToPage = function(runabout) {
	for(var r = 0; r < runabout.length; r++) {
		var runaboutUL = document.getElementById('Pelican_Crew');
		var runaboutLI = document.createElement('li');
		runaboutLI.className = 'crew_member';
		var memberIMG = document.createElement('div');
		memberIMG.className = 'crew_img';
		if (runabout[r].img == null) {
			memberIMG.innerHTML = '<img src="lp_img/old_site_images/userTest.png">';
		} else {
			memberIMG.innerHTML = '<img src="' + runabout[r].img + '">';
		};
		var memberInfo = document.createElement('div');
		memberInfo.className = 'crew_info';
		var memberName = document.createElement('div');
	    memberName.className = 'crew_name';
	    memberName.innerHTML = runabout[r].name;
	    var memberDept = document.createElement('div');
	    memberDept.className = 'runabout_dept';
	    memberDept.innerHTML = runabout[r].dept;
	    var memberRank = document.createElement('div');
	    memberRank.className = 'crew_rank';
	    memberRank.innerHTML = runabout[r].rank;
	    var memberDesc = document.createElement('div');
	    memberDesc.className = 'crew_desc';
	    memberDesc.innerHTML = '<p>'+runabout[r].desc+'</p>';
	    memberInfo.appendChild(memberName);
	    memberInfo.appendChild(memberRank);
	    memberInfo.appendChild(memberDept);
	    memberInfo.appendChild(memberDesc);
	    runaboutLI.appendChild(memberIMG);
	    runaboutLI.appendChild(memberInfo);
	}
}

var addAlumnoToPage = function(alumni) {
	for(var a = 0; a < a.length; a++) {
		var alumniUL = document.getElementById('Crew_Alumni');
		var alumniLI = document.createElement('li');
		alumnitLI.className = 'crew_member';
		var memberIMG = document.createElement('div');
		memberIMG.className = 'crew_img';
		if (alumni[a].img == null) {
			memberIMG.innerHTML = '<img src="lp_img/old_site_images/userTest.png">';
		} else {
			memberIMG.innerHTML = '<img src="' + alumni[a].img + '">';
		};
		var memberInfo = document.createElement('div');
		memberInfo.className = 'crew_info';
		var memberName = document.cralumnieateElement('div');
	    memberName.className = 'crew_name';
	    memberName.innerHTML = alumni[a].name;
	    var memberDept = document.createElement('div');
	    memberDept.className = 'runabout_dept';
	    memberDept.innerHTML = alumni[a].dept;
	    var memberRank = document.createElement('div');
	    memberRank.className = 'crew_rank';
	    memberRank.innerHTML = alumni[a].rank;
	    var memberDesc = document.createElement('div');
	    memberDesc.className = 'crew_desc';
	    memberDesc.innerHTML = '<p>'+alumni[a].desc+'</p>';
	    memberInfo.appendChild(memberName);
	    memberInfo.appendChild(memberRank);
	    memberInfo.appendChild(memberDept);
	    memberInfo.appendChild(memberDesc);
	    runaboutLI.appendChild(memberIMG);
	    runaboutLI.appendChild(memberInfo);
	}
}

jQuery(document).ready(function() {
	getCrewRoster(url);
}); 