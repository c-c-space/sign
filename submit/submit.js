StartAudioContext(Tone.context, window);
$(window).click(function() {
    Tone.context.resume();
});

var volume = new Tone.Volume(5);
var click = new Tone.FMSynth(5, Tone.Synth).chain(volume, Tone.Master);
var notes = Tone.Frequency("G4").harmonize([1, 3, 6, 8, 10, ]);
var noteIndex = 0;

$("#click .click").click(function(e) {
    var randNote = Math.floor(Math.random() * notes.length);
    click.triggerAttackRelease(notes[randNote], "10n");
});