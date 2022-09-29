var volume = new Tone.Volume(-10);
var synth = new Tone.PolySynth(5, Tone.Synth).chain(volume, Tone.Master);
var notes = Tone.Frequency("E3").harmonize([
    7, 10, 12,
    10, 12, 14,
    12, 14, 17,
]);
var noteIndex = 1;

StartAudioContext(Tone.context, window);
$(window).click(function () {
    Tone.context.resume();
});


$(function () {
    var arr = [];
    $("#random li").each(function () {
        arr.push($(this).html());
    });
    arr.sort(function () {
        return Math.random() - Math.random();
    });
    $("#random").empty();
    for (i = 0; i < arr.length; i++) {
        $("#random").append('<li>' + arr[i] + '</li>');
    }
});

window.addEventListener('load', function () {
    viewSlide('.flash li');
});

function viewSlide(className, flashNo = -1) {
    let randNote = Math.floor(Math.random() * notes.length);
    synth.triggerAttackRelease(notes[randNote], "5");

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
    setTimeout(function () {
        viewSlide(className, flashNo);
    }, msec);
}