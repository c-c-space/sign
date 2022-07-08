StartAudioContext(Tone.context, window);
$(window).click(function() {
    Tone.context.resume();
});

var volume = new Tone.Volume(5);
var click = new Tone.Synth(5, Tone.Synth).chain(volume, Tone.Master);
var number = Tone.Frequency("F3").harmonize([1, 3, 6, 8, 10, ]);
var numberIndex = 0;

$("#click .click").click(function(e) {
    var numberNote = Math.floor(Math.random() * number.length);
    click.triggerAttackRelease(number[numberNote], "10n");
});