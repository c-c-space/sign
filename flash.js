var synth = new Tone.FMSynth(5, Tone.Synth).toMaster();
var notes = Tone.Frequency("F3").harmonize([
    1, 3, 6, 8, 10,
    3, 6, 8, 10, 13,
    6, 8, 10, 13, 15,
    8, 10, 13, 15, 18,
    10, 13, 15, 18, 20,
    13, 15, 18, 20, 22,
    15, 18, 20, 22, 25
]);
var noteIndex = 0;

StartAudioContext(Tone.context, window);
$(window).click(function() {
    Tone.context.resume();
});


$(function() {
    var arr = [];
    $("#random li").each(function() {
        arr.push($(this).html());
    });
    arr.sort(function() {
        return Math.random() - Math.random();
    });
    $("#random").empty();
    for (i = 0; i < arr.length; i++) {
        $("#random").append('<li>' + arr[i] + '</li>');
    }
});

window.addEventListener('load', function() {
    viewSlide('.flash li');
});

function viewSlide(className, flashNo = -1) {
    var randNote = Math.floor(Math.random() * notes.length);
    synth.triggerAttackRelease(notes[randNote], "2n");

    let imgArray = document.querySelectorAll(className);
    if (flashNo >= 0) {
        imgArray[flashNo].style.opacity = 0;
    }
    flashNo++;
    if (flashNo >= imgArray.length) {
        flashNo = 0;
    }
    imgArray[flashNo].style.opacity = 1;
    let msec = document.getElementById('flash_speed').max - document.getElementById('flash_speed').value;
    setTimeout(function() {
        viewSlide(className, flashNo);
    }, msec);
}