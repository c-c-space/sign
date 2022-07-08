StartAudioContext(Tone.context, window);
$(window).click(function() {
    Tone.context.resume();
});

var volume = new Tone.Volume(7);
var click = new Tone.FMSynth(7, Tone.Synth).chain(volume, Tone.Master);
var notes = Tone.Frequency("G4").harmonize([
    1, 3, 6, 8, 10,
    3, 6, 8, 10, 13,
    6, 8, 10, 13, 15,
    8, 10, 13, 15, 18,
    10, 13, 15, 18, 20,
    13, 15, 18, 20, 22,
    15, 18, 20, 22, 25
]);
var noteIndex = 0;

$("#click .click").click(function(e) {
    var randNote = Math.floor(Math.random() * notes.length);
    click.triggerAttackRelease(notes[randNote], "10n");
});