/*
    AD Metrics
*/
setTimeout( function() {
//Ad Error
jwplayer().on('adError', function() {
ga("send", "event", "JW Player Video", "Ad Error", pageTitle, {nonInteraction: true});
console.log('adError');
});
//HN Page Ad Blocks M7
jwplayer().on('adBlock', function() {
ga("send", "event", "JW Player Video", "Ad Block", pageTitle, {nonInteraction: true});
ga("send", 'event', 'HN Page Ad Blocks', 'Ad Block', pageTitle, {nonInteraction: true, metric7: 1});
console.log('adBlock');
});

//HN Video Ad Starts  M1
jwplayer().on('adStarted', function() {
ga("send", "event", "JW Player Video", "Ad Started", pageTitle, {nonInteraction: true});
ga("send", 'event', 'HN Video Ad Starts', 'Ad Started', pageTitle, {nonInteraction: true,  metric1: 1});
console.log('adStarted');
});

//HN Video Ad Skips M3
jwplayer().on('adSkipped', function() {
ga("send", 'event', 'HN Video Ad Skips', 'Ad Skips', pageTitle, {nonInteraction: true,  metric3: 1});
console.log('adSkipped');
});

//HN Video Ad click  M10
jwplayer().on('adClick', function() {
ga("send", 'event', 'HN Video Ad click', 'Ad Clicked', pageTitle, {nonInteraction: true,  metric10: 1});
console.log('adClicked');
});

//HN Video Ad Completion (50%) M11
var fired = 0;
jwplayer().on('adTime', function(event) {
  const { duration, position } = event;
  if ((position > duration/2) && (fired == 0)) {
    ga("send", 'event', 'HN Video Ad Completions (50%)', 'Ad Complete', pageTitle, {nonInteraction: true, metric11: 1});
    fired++;
  }
});

//HN Video Ad Completions (100%) M2
jwplayer().on('adComplete', function() {
ga("send", "event", "JW Player Video", "Ad Complete", pageTitle, {nonInteraction: true});
ga("send", 'event', 'HN Video Ad Completions (100%)', 'Ad Complete', pageTitle, {nonInteraction: true, metric2: 1});
console.log('adComplete');
console.log(e);
});

jwplayer().on('adViewableImpression', function() {
ga("send", "event", "JW Player Video", "Ad Viewable Impression", pageTitle, {nonInteraction: true});
console.log('adViewableImpression');
});


/*
    VIDEO Metrics
*/
//Auto Start is not Allowed
jwplayer().on('autostartNotAllowed', function() {
ga("send", "event", "JW Player Video", "Auto Start Not Allowed", pageTitle, {nonInteraction: true});
console.log('autostartNotAllowed');
});

//HN Video Content Starts M4
jwplayer().on('firstFrame', function() {
ga("send", 'event', 'HN Video Content Starts', 'Content Starts', pageTitle, {nonInteraction: true, metric4: 1});
console.log('VdStarts');
});

//HN Video Content Completions (90%) M5
jwplayer().on('complete', function() {
ga("send", 'event', 'HN Video Content Completions', 'Video Complete', pageTitle, {nonInteraction: true, metric5: 1});
console.log('VdComplete');
});
}, 3000 );
//HN Page Banner-Only Displays M8

//HN Social Share Button Clicks M9
