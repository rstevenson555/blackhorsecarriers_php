/*
 * OpenTag, a tag deployment platform
 * Copyright 2011, QuBit Group
 * http://opentag.qubitproducts.com
 */

try{(function(){var a={};a.html={};a.html.fileLoader={};a.html.fileLoader.load=function(m,v,x,s,q){var n,o,u,t,p,r;r=false;p=function(){if(!r){r=true;x(m,u);if(t){window.onerror=t}else{window.onerror=null}}};try{if(v){o=v(m)}}catch(w){o=false}finally{if(o!==false){n=a.html.fileLoader.createScriptEl(m,q);if(x){n.onload=p;n.onreadystatechange=function(){if((this.readyState==="complete")||(this.readyState==="loaded")){setTimeout(p,1)}}}if(!s){s=window.document.getElementsByTagName("head")[0]}if(window.onerror){t=window.onerror}window.onerror=function(A,z,y){u={reason:A,url:z,lineNumber:y};return true};s.appendChild(n)}}};a.html.fileLoader.createScriptEl=function(o,n,p){var m=document.createElement("script");m.type="text/javascript";m.src=a.html.fileLoader.tidyUrl(o)+(p?("?"+new Date().getTime()):"");if(n!==false){m.async="true";m.defer="true"}else{m.async="false";if(m.async!==false){m.async=false}m.defer="false"}return m};a.html.fileLoader.tidyUrl=function(m){if(m.substring(0,5)==="http:"){return m}if(m.substring(0,6)==="https:"){return m}return"//"+m};a.html.PostData=function(n,q,u){var x,p,w,m;p=navigator.userAgent.toLowerCase();w=p.indexOf("msie")!==-1;m=((p.indexOf("msie 7")!==-1)||(p.indexOf("msie 6")!==-1));n=("https:"===document.location.protocol?"https:":"http:")+n;if(m){a.html.fileLoader.load(n);return}try{u=u?u:"POST";x=null;try{x=new XMLHttpRequest()}catch(v){}if(x&&!w){x.open(u,n,true)}else{if(typeof XDomainRequest!=="undefined"){x=new XDomainRequest();x.open(u,n);x.onload=function(){}}else{x=null}}try{x.withCredentials=false}catch(t){}if(x.setRequestHeader){x.setRequestHeader("Content-Type","text/plain;charset=UTF-8")}x.send(q)}catch(o){try{try{a.html.fileLoader.load(n)}catch(s){if(window.console&&window.console.log){window.console.log(o)}}}catch(r){}}};a.html.GlobalEval={};a.html.GlobalEval.globalEval=function(n){if(window.execScript){window.execScript(n)}else{var m=function(){window["eval"].call(window,n)};m()}};a.html.HtmlInjector={};a.html.HtmlInjector.inject=function(m,u,t,o,r){var q,x,s,w,p,v,n;if(t.toLowerCase().indexOf("<script")>=0){s=document.createElement("div");s.innerHTML="a"+t;w=s.getElementsByTagName("script");p=[];for(q=0,x=w.length;q<x;q+=1){p.push(w[q])}n=[];for(q=0,x=p.length;q<x;q+=1){v=p[q];if(v.src){n.push({src:v.src})}else{n.push({script:v.innerHTML})}v.parentNode.removeChild(v)}if(s.innerHTML){if(s.innerHTML.length>0){s.innerHTML=s.innerHTML.substring(1)}}a.html.HtmlInjector.doInject(m,u,s);a.html.HtmlInjector.loadScripts(n,0,o,m)}else{s=document.createElement("div");s.innerHTML=t;a.html.HtmlInjector.doInject(m,u,s);if(o){o()}}};a.html.HtmlInjector.doInject=function(o,n,p){if(p.childNodes.length>0){var m=document.createDocumentFragment();while(p.childNodes.length>0){m.appendChild(p.removeChild(p.childNodes[0]))}if(n){a.html.HtmlInjector.injectAtStart(o,m)}else{a.html.HtmlInjector.injectAtEnd(o,m)}}};a.html.HtmlInjector.injectAtStart=function(n,m){if(n.childNodes.length===0){n.appendChild(m)}else{n.insertBefore(m,n.childNodes[0])}};a.html.HtmlInjector.injectAtEnd=function(o,n,m){if(!m){m=1}if((o===document.body)&&(document.readyState!=="complete")&&(m<50)){setTimeout(function(){a.html.HtmlInjector.injectAtEnd(o,n,m+1)},100)}else{o.appendChild(n)}};a.html.HtmlInjector.loadScripts=function(q,o,n,m){var p,s,r=false;for(p=q.length;o<p;o+=1){s=q[o];if(s.src){r=true;break}else{a.html.GlobalEval.globalEval(s.script)}}if(r){a.html.fileLoader.load(s.src,null,function(){a.html.HtmlInjector.loadScripts(q,o+1,n,m)},m)}if(n&&(o===p)){n()}};a.cookie={};a.cookie.PageView={};a.cookie.PageView.update=function(){var m,o;o=function n(){return(Math.floor(1+Math.random())*65536).toString(36).substring(1)};if(!window.__pageViewId__){m=new Date().getTime().toString(36);window.__pageViewId__=m+o()+o()+o()}return window.__pageViewId__};var d=false;var g="";var c=[],j={},f="",b="",k=0,h=null;var f="48148";var b="137748";var c=[{filterType:"1",patternType:"1",pattern:"",priority:1,scriptLoaderKeys:["806629"]},{filterType:"1",patternType:"1",pattern:"",priority:1,scriptLoaderKeys:["878115"]},{filterType:"1",patternType:"3",pattern:"index\\.php$",priority:1,scriptLoaderKeys:["915480"]},{filterType:"1",patternType:"3",pattern:"$",priority:2,scriptLoaderKeys:["915480"]}];var j={806629:{id:"806629",name:"ga",pre:"",url:"",post:"",html:"<script type=\x27text/javascript\x27>\x0A\x0A  var _gaq = _gaq || [];\x0A  _gaq.push([\x27_setAccount\x27, \x27UA-12682212-1\x27]);\x0A  _gaq.push([\x27_trackPageview\x27]);\x0A\x0A  (function() {\x0A    var ga = document.createElement(\x27script\x27); ga.type = \x27text/javascript\x27; ga.async = true;\x0A    ga.src = (\x27https:\x27 == document.location.protocol ? \x27https://ssl\x27 : \x27http://www\x27) + \x27.google-analytics.com/ga.js\x27;\x0A    var s = document.getElementsByTagName(\x27script\x27)[0]; s.parentNode.insertBefore(ga, s);\x0A  })();\x0A\x0A<\/script>",locationId:1,positionId:2,locationDetail:"",async:true,needsConsent:false,usesDocWrite:false},878115:{id:"878115",name:"jquery-head",pre:"",url:"ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js",post:"",html:"",locationId:1,positionId:1,locationDetail:"main",async:false,needsConsent:false,usesDocWrite:false},915480:{id:"915480",name:"home_animation",pre:"",url:"www.blackhorsecarriers.com/scripts/home_animation.js",post:"",html:"",locationId:2,positionId:2,locationDetail:"main",async:true,needsConsent:false,usesDocWrite:false}};var k=1;var h="pong.qubitproducts.com";function l(o,n){var m,q,p;p={};l.docWriteUsers=[];l.errors={};l.isTellingLoadTimes=k>Math.random();if(l.isTellingLoadTimes){l.loadTimes={}}m=l.getFilterStates(o,document.location.href,p);l.qTagLoaders=l.getLoaders(m,n);l.qTagLoaderCount=0;l.loadTimesSent=false;l.loadersStarted=0;l.loadersFinished=0;l.runStarters(m,p)}l.ALL="1";l.SUBSTRING="2";l.REGEX="3";l.EXACT_MATCH="4";l.FN="100";l.DEDUPE_FN="110";l.FILTER_TYPE_INCLUDE="1";l.FILTER_TYPE_EXCLUDE="2";l.NORMAL_FILTER="1";l.DEDUPE_URL_FILTER="2";l.DEDUPE_SESSION_FILTER="3";l.getFilterStates=function(r,m,t){var n,q,p,s={},o=[];if((!r)||(!m)){return o}for(n=0,q=r.length;n<q;n+=1){p=r[n];if(l.doesFilterMatch(p,m,t)){o.push(p)}}o.sort(function(v,u){return u.priority-v.priority});return o};l.getLoaders=function(q,r,n){var o,p,s={},m={};for(o=0,p=q.length;o<p;o+=1){l.updateLoaders(q[o],s)}for(o in s){if(s.hasOwnProperty(o)){m[o]=r[o];m[o].dedupe=s[o];m[o].state=0}}return m};l.updateLoaders=function(q,r){var n,p,o,m=q.scriptLoaderKeys;if(q.filterType===l.FILTER_TYPE_INCLUDE){for(n=0,p=m.length;n<p;n+=1){o=l.getFilterType(q);if((o===l.NORMAL_FILTER)||(o===l.DEDUPE_URL_FILTER)||(r[m[n]]===l.DEDUPE_URL_FILTER)){r[m[n]]=o}}}else{if(q.filterType===l.FILTER_TYPE_EXCLUDE){for(n=0,p=m.length;n<p;n+=1){delete r[m[n]]}}}};l.getFilterType=function(n){var m=parseInt(n.patternType,10);if((m<10)||(m===100)){return l.NORMAL_FILTER}if((m>=10)&&(m<20)){return l.DEDUPE_URL_FILTER}if(m===110){return l.DEDUPE_SESSION_FILTER}};l.runStarters=function(o,p){var m,n;for(m=0,n=o.length;m<n;m+=1){o[m].starter(p,l.createStarterCb(o[m]))}};l.createStarterCb=function(m){return function(){var p,q,o,n=[];for(p=0,q=m.scriptLoaderKeys.length;p<q;p+=1){o=l.qTagLoaders[m.scriptLoaderKeys[p]];if(o&&(o.state===0)&&(o.dedupe!==l.DEDUPE_URL_FILTER)){if(!((o.dedupe===l.DEDUPE_SESSION_FILTER)&&(m.patternType!==l.DEDUPE_FN))){if(!o.counted){l.qTagLoaderCount+=1;o.counted=true;n.push(o)}}}}for(p=0,q=n.length;p<q;p+=1){l.loadLoader(n[p])}}};l.doesFilterMatch=function(n,m,p){var o=false;switch(n.patternType){case l.FN:case l.DEDUPE_FN:o=n.pattern(p);break;case l.EXACT_MATCH:case"1"+l.EXACT_MATCH:if(m.toLowerCase()===n.pattern.toLowerCase()){o=true}break;case l.SUBSTRING:case"1"+l.SUBSTRING:if(m.toLowerCase().indexOf(n.pattern.toLowerCase())>=0){o=true}break;case l.REGEX:case"1"+l.REGEX:if(new RegExp(n.pattern).test(m)){o=true}break;case l.ALL:case"1"+l.ALL:o=true;break}if(o&&!n.starter){n.starter=function(r,q){q()}}return o};l.waitCounts={};l.maxLoads=10;l.loadCheckInterval=500;l.loadLoader=function(m){var n;
try{m.state=1;if(m.usesDocWrite){l.docWriteUsers.push(m);l.loadLoadersSequentially()}else{l.doWhenReady(m,l.loadTagLoader,function(){})}}catch(o){m.state=-1;n={reason:"error parsing loader, "+m.id+": "+o.reason,url:document.location.href};l.errors[m.id]=n;if(window.debug){window.console.log(n)}}};l.doWhenReady=function(m,n,o){l.waitCounts[m.id]=0;l._doWhenReady(m,n,o)};l._doWhenReady=function(m,n,o){if(l.canLoad(m)){n(m)}else{if(l.waitCounts[m.id]<l.maxLoads){l.waitCounts[m.id]+=1;setTimeout(function(){l._doWhenReady(m,n,o)},l.loadCheckInterval)}else{o(m)}}};l.canLoad=function(m){if(m.locationId===2){return !!document.body}else{if(m.locationId===3){return !!document.getElementById(m.locationDetail)}}return true};l.loadingSequentially=false;l.loadLoadersSequentially=function(){var m;if(!l.loadingSequentially&&(l.docWriteUsers.length>0)){l.loadingSequentially=true;m=l.docWriteUsers[0];l.docWriteUsers.shift();l.doWhenReady(m,l.loadLoaderSequentially,function(){l.loadLoadersSequentially()})}else{l.loadingSequentially=false}};l.loadLoaderSequentially=function(m){var o=[],n;document.write=function(p){o.push(p)};document.writeln=function(p){o.push(p)};n=function(){var p=l.getLocation(m);a.html.HtmlInjector.inject(p,m.positionId===1,o.join("\n"),l.loadLoadersSequentially)};m.finishHandler=n;l.loadTagLoader(m)};l.loadTagLoader=function(m){var n=l.getTimerEnder(m);try{if(m.url){a.html.fileLoader.load(m.url,l.getTimerStarter(m),n,m.parentNode,m.async)}else{if(m.html){l.injectHtml(m)}}}catch(o){n(null,o)}};l.injectHtml=function(m){var n=l.getLocation(m);l.getTimerStarter(m)();a.html.HtmlInjector.inject(n,m.positionId===1,m.html,l.getTimerEnder(m))};l.getLocation=function(m){var n;if(m.locationId===1){n=document.getElementsByTagName("head")[0]}else{if(m.locationId===2){n=document.body}else{if(m.locationId===3){n=document.getElementById(m.locationDetail)}else{n=document.body}}}return n};l.getTimerStarter=function(m){if(l.isTellingLoadTimes){l.loadTimes[m.id]={start:new Date().getTime()}}return l.createStatementEvaluator(m.pre,true)};l.getTimerEnder=function(m){return function(o,n){m.state=2;if(l.isTellingLoadTimes){l.loadTimes[m.id].end=new Date().getTime()}if(n){l.errors[m.id]=n}if(m.finishHandler){m.finishHandler()}return l.createStatementEvaluator(m.post,false)()}};l.createStatementEvaluator=function(m,n){if((!!m)&&(m.length>0)){return function(){a.html.GlobalEval.globalEval(m);l.incrementLoadCounter(n)}}else{return function(){l.incrementLoadCounter(n)}}};l.incrementLoadCounter=function(n){var m;if(n){l.loadersStarteded+=1}else{l.loadersFinished+=1}if((l.loadersFinished===l.qTagLoaderCount)||(l.loadTimesSent&&(l.loadersStarted===l.loadersFinished))){m=l.loadTimesSent;if(!m&&window.qTag_allLoaded){window.qTag_allLoaded()}l.loadTimesSent=true}};var i=new l(c||[],j||{})}())}catch(e){try{if(debug){console.debug(e)}}catch(ex){}};