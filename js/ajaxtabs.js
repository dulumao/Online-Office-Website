//** Ajax Tabs Content script v2.0- ?Dynamic Drive DHTML code library (http://www.dynamicdrive.com)
//** Updated Oct 21st, 07 to version 2.0. Contains numerous improvements

var ddajaxtabssettings={}
ddajaxtabssettings.bustcachevar=1  //bust potential caching of external pages after initial request? (1=yes, 0=no)
ddajaxtabssettings.loadstatustext="<img src='ajaxtabs/loading.gif' /> Requesting content..." 


////NO NEED TO EDIT BELOW////////////////////////

function ddajaxtabs(tabinterfaceid, contentdivid){
	this.tabinterfaceid=tabinterfaceid //ID of Tab Menu main container
	this.tabs=document.getElementById(tabinterfaceid).getElementsByTagName("a") //Get all tab links within container
	this.enabletabpersistence=true
	this.hottabspositions=[] //Array to store position of tabs that have a "rel" attr defined, relative to all tab links, within container
	this.contentdivid=contentdivid
	this.defaultHTML=""
	this.defaultIframe='<iframe src="about:blank" marginwidth="0" marginheight="0" frameborder="0" vspace="0" hspace="0" class="tabcontentiframe" style="width:100%; height:300px; min-height: 100px"></iframe>'
	this.defaultIframe=this.defaultIframe.replace(/<iframe/i, '<iframe name="'+"_ddajaxtabsiframe-"+contentdivid+'" ')
this.revcontentids=[] //Array to store ids of arbitrary contents to expand/contact as well ("rev" attr values)
	this.selectedClassTarget="link" //keyword to indicate which target element to assign "selected" CSS class ("linkparent" or "link")
}

ddajaxtabs.connect=function(pageurl, tabinstance){
	var page_request = false
	var bustcacheparameter=""
	if (window.XMLHttpRequest) // if Mozilla, IE7, Safari etc
		page_request = new XMLHttpRequest()
	else if (window.ActiveXObject){ // if IE6 or below
		try {
		page_request = new ActiveXObject("Msxml2.XMLHTTP")
		} 
		catch (e){
			try{
			page_request = new ActiveXObject("Microsoft.XMLHTTP")
			}
			catch (e){}
		}
	}
	else
		return false
	var ajaxfriendlyurl=pageurl.replace(/^http:\/\/[^\/]+\//i, "http://"+window.location.hostname+"/") 
	page_request.onreadystatechange=function(){ddajaxtabs.loadpage(page_request, pageurl, tabinstance)}
	if (ddajaxtabssettings.bustcachevar) //if bust caching of external page
		bustcacheparameter=(ajaxfriendlyurl.indexOf("?")!=-1)? "&"+new Date().getTime() : "?"+new Date().getTime()
	page_request.open('GET', ajaxfriendlyurl+bustcacheparameter, true)
	page_request.send(null)
}

ddajaxtabs.loadpage=function(page_request, pageurl, tabinstance){
	var divId=tabinstance.contentdivid
	document.getElementById(divId).innerHTML=ddajaxtabssettings.loadstatustext //Display "fetching page message"
	if (page_request.readyState == 4 && (page_request.status==200 || window.location.href.indexOf("http")==-1)){
		document.getElementById(divId).innerHTML=page_request.responseText
		ddajaxtabs.ajaxpageloadaction(pageurl, tabinstance)
	}
}

ddajaxtabs.ajaxpageloadaction=function(pageurl, tabinstance){
	tabinstance.onajaxpageload(pageurl) //call user customized onajaxpageload() function when an ajax page is fetched/ loaded
}

ddajaxtabs.getCookie=function(Name){ 
	var re=new RegExp(Name+"=[^;]+", "i"); //construct RE to search for target name/value pair
	if (document.cookie.match(re)) //if cookie found
		return document.cookie.match(re)[0].split("=")[1] //return its value
	return ""
}

ddajaxtabs.setCookie=function(name, value){
	document.cookie = name+"="+value+";path=/" //cookie value is domain wide (path=/)
}

ddajaxtabs.prototype={

	expandit:function(tabid_or_position){ //PUBLIC function to select a tab either by its ID or position(int) within its peers
		this.cancelautorun() //stop auto cycling of tabs (if running)
		var tabref=""
		try{
			if (typeof tabid_or_position=="string" && document.getElementById(tabid_or_position).getAttribute("rel")) //if specified tab contains "rel" attr
				tabref=document.getElementById(tabid_or_position)
			else if (parseInt(tabid_or_position)!=NaN && this.tabs[tabid_or_position].getAttribute("rel")) //if specified tab contains "rel" attr
				tabref=this.tabs[tabid_or_position]
		}
		catch(err){alert("Invalid Tab ID or position entered!")}
		if (tabref!="") //if a valid tab is found based on function parameter
			this.expandtab(tabref) //expand this tab
	},

	setpersist:function(bool){ //PUBLIC function to toggle persistence feature
			this.enabletabpersistence=bool
	},

	loadajaxpage:function(pageurl){ //PUBLIC function to fetch a page via Ajax and display it within the Tab Content instance's container
		ddajaxtabs.connect(pageurl, this)
	},

	loadiframepage:function(pageurl){ //PUBLIC function to fetch a page and load it into the IFRAME of the Tab Content instance's container
		this.iframedisplay(pageurl, this.contentdivid)
	},

	setselectedClassTarget:function(objstr){ //PUBLIC function to set which target element to assign "selected" CSS class ("linkparent" or "link")
		this.selectedClassTarget=objstr || "link"
	},

	getselectedClassTarget:function(tabref){ //Returns target element to assign "selected" CSS class to
		return (this.selectedClassTarget==("linkparent".toLowerCase()))? tabref.parentNode : tabref
	},

	onajaxpageload:function(pageurl){ //PUBLIC Event handler that can invoke custom code whenever an Ajax page has been fetched and displayed
		//do nothing by default
	},

	expandtab:function(tabref){
		var relattrvalue=tabref.getAttribute("rel")
		//Get "rev" attr as a string of IDs in the format ",john,george,trey,etc," to easy searching through
		var associatedrevids=(tabref.getAttribute("rev"))? ","+tabref.getAttribute("rev").replace(/\s+/, "")+"," : ""
		if (relattrvalue=="#default")
			document.getElementById(this.contentdivid).innerHTML=this.defaultHTML
		else if (relattrvalue=="#iframe")
			this.iframedisplay(tabref.getAttribute("href"), this.contentdivid)
		else
			ddajaxtabs.connect(tabref.getAttribute("href"), this)
		this.expandrevcontent(associatedrevids)
		for (var i=0; i<this.tabs.length; i++){ //Loop through all tabs, and assign only the selected tab the CSS class "selected"
			this.getselectedClassTarget(this.tabs[i]).className=(this.tabs[i].getAttribute("href")==tabref.getAttribute("href"))? "selected" : ""
		}
		if (this.enabletabpersistence) //if persistence enabled, save selected tab position(int) relative to its peers
			ddajaxtabs.setCookie(this.tabinterfaceid, tabref.tabposition)
	},

	iframedisplay:function(pageurl, contentdivid){
		if (typeof window.frames["_ddajaxtabsiframe-"+contentdivid]!="undefined"){
			try{delete window.frames["_ddajaxtabsiframe-"+contentdivid]} //delete iframe within Tab content container if it exists (due to bug in Firefox)
			catch(err){}
		}
		document.getElementById(contentdivid).innerHTML=this.defaultIframe
		window.frames["_ddajaxtabsiframe-"+contentdivid].location.replace(pageurl) //load desired page into iframe
	},


	expandrevcontent:function(associatedrevids){
		var allrevids=this.revcontentids
		for (var i=0; i<allrevids.length; i++){ //Loop through rev attributes for all tabs in this tab interface
			//if any values stored within associatedrevids matches one within allrevids, expand that DIV, otherwise, contract it
			document.getElementById(allrevids[i]).style.display=(associatedrevids.indexOf(","+allrevids[i]+",")!=-1)? "block" : "none"
		}
	},

	autorun:function(){ //function to auto cycle through and select tabs based on a set interval
		var currentTabIndex=this.automode_currentTabIndex //index within this.hottabspositions to begin
		var hottabspositions=this.hottabspositions //Array containing position numbers of "hot" tabs (those with a "rel" attr)
		this.expandtab(this.tabs[hottabspositions[currentTabIndex]])
		this.automode_currentTabIndex=(currentTabIndex<hottabspositions.length-1)? currentTabIndex+1 : 0 //increment currentTabIndex
	},

	cancelautorun:function(){
		if (typeof this.autoruntimer!="undefined")
			clearInterval(this.autoruntimer)
	},

	init:function(automodeperiod){
		var persistedtab=ddajaxtabs.getCookie(this.tabinterfaceid) //get position of persisted tab (applicable if persistence is enabled)
		var persisterror=true //Bool variable to check whether persisted tab position is valid (can become invalid if user has modified tab structure)
		this.automodeperiod=automodeperiod || 0
		this.defaultHTML=document.getElementById(this.contentdivid).innerHTML
		for (var i=0; i<this.tabs.length; i++){
			this.tabs[i].tabposition=i //remember position of tab relative to its peers
			if (this.tabs[i].getAttribute("rel")){
				var tabinstance=this
				this.hottabspositions[this.hottabspositions.length]=i //store position of "hot" tab ("rel" attr defined) relative to its peers
				this.tabs[i].onclick=function(){
					tabinstance.expandtab(this)
					tabinstance.cancelautorun() //stop auto cycling of tabs (if running)
					return false
				}
				if (this.tabs[i].getAttribute("rev")){ //if "rev" attr defined, store each value within "rev" as an array element
					this.revcontentids=this.revcontentids.concat(this.tabs[i].getAttribute("rev").split(/\s*,\s*/))
				}
				if (this.enabletabpersistence && parseInt(persistedtab)==i || !this.enabletabpersistence && this.getselectedClassTarget(this.tabs[i]).className=="selected"){
					this.expandtab(this.tabs[i]) //expand current tab if it's the persisted tab, or if persist=off, carries the "selected" CSS class
					persisterror=false //Persisted tab (if applicable) was found, so set "persisterror" to false
					//If currently selected tab's index(i) is greater than 0, this means its not the 1st tab, so set the tab to begin in automode to 1st tab:
					this.automode_currentTabIndex=(i>0)? 0 : 1
				}
			}
		} //END for loop
		if (persisterror) //if an error has occured while trying to retrieve persisted tab (based on its position within its peers)
			this.expandtab(this.tabs[this.hottabspositions[0]]) //Just select first tab that contains a "rel" attr
		if (parseInt(this.automodeperiod)>500 && this.hottabspositions.length>1){
			this.automode_currentTabIndex=this.automode_currentTabIndex || 0
			this.autoruntimer=setInterval(function(){tabinstance.autorun()}, this.automodeperiod)
		}
	} //END int() function

} //END Prototype assignment/*��������һ���ز���www.16sucai.com*/