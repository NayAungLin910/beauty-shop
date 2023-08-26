<script>
    let identity = ""; // global identity variable
    let event = "";
    let id = 0;

// open popup and display
function openPopupSubmit(text, identity, serious = false, event = "", id = 0) {
    document.querySelector(`#popup-overlay`).classList.toggle('active'); // show popup overlay
    document.querySelector(`#popup`).classList.toggle('active'); // show popup
    if(serious) {
        document.querySelector(`#popup`).classList.add('border-red-500'); // if the popup asks seriuos question then make the border yed
    }else {
        document.querySelector(`#popup`).classList.add('border-pink-500');
    }
    
    document.querySelector(`#popup-text`).innerHTML = text; // show the given popup text
    this.identity = identity; // assign identity to global identity variable
    this.event = event;
    this.id = id;
}

// accept popup
function acceptPopup() {

    if(this.event === "") {
        document.getElementById(`${this.identity}-accept-form`).submit(); // submit the given form 
    }else {
        console.log(this.event, this.id)
        Livewire.dispatch(this.event, {id: this.id});
    }
    
    document.querySelector(`#popup`).classList.toggle('active'); // close popup 
    document.querySelector(`#popup-overlay`).classList.toggle('active'); // close popup overlay
}

// close popup
function closePopup() {
    let popup = document.querySelector(`#popup`);
    popup.classList.toggle('active'); // close popup
    document.querySelector(`#popup-overlay`).classList.toggle('active'); // close popup overlay
}
</script>