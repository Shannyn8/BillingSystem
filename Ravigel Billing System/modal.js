document.addEventListener("DOMContentLoaded", function () {
    const openButtons = document.querySelectorAll("[data-open-modal]");
    const modal = document.querySelector("[data-modal]");
    const form = document.querySelector("#buyModal form");
    const eventNameInput = document.querySelector(".event");
    const priceInput = document.querySelector(".price");

    openButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const eventName = button.getAttribute("data-event-name");
            const eventPrice = button.getAttribute("data-event-price");

            eventNameInput.value = eventName;
            priceInput.value = eventPrice;

            document.getElementById("itemNameSpan").textContent = `You are buying ${eventName}`;
            document.getElementById("amountSpan").textContent = `Amount is ₱${eventPrice}`;

            modal.showModal();
        });
    });

    modal.addEventListener("click", (e) => {
        if (e.target === modal) {
            modal.close();
        }
    });
    /*
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('transaction.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            modal.close();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    */
});
/*
document.addEventListener("DOMContentLoaded", function () {
    const openButtons = document.querySelectorAll("[data-open-modal]");
    const modal = document.querySelector("[data-modal]");
    const form = document.querySelector("#buyModal form");
    const eventNameInput = document.querySelector(".event");
    const priceInput = document.querySelector(".price");
    openButtons.forEach((button) => {
        button.addEventListener("click", () => {
            const eventName = button.getAttribute("data-event-name");
            const eventPrice = button.getAttribute("data-event-price");
            eventNameInput.value = eventName;
            priceInput.value = eventPrice;
            document.getElementById("itemNameSpan").textContent = `You are buying ${eventName}`;
            document.getElementById("amountSpan").textContent = `Amount is ₱${eventPrice}`;
            modal.showModal();
        });
    });
    modal.addEventListener("click", (e) => {
        const dialogDimensions = modal.getBoundingClientRect();
        if (
            e.clientX < dialogDimensions.left ||
            e.clientX > dialogDimensions.right ||
            e.clientY < dialogDimensions.top ||
            e.clientY > dialogDimensions.bottom
        ) {
            modal.close();
        }
    });
    /*
    form.addEventListener("submit", function (e) {
        e.preventDefault();

        const formData = new FormData(this);

        fetch('transaction.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.text())
        .then(data => {
            console.log(data);
            modal.close();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
    
});
*/

/*
const openButton = document.querySelectorAll("[data-open-modal]");
openButton.forEach(button => {
    button.addEventListener("click", () => {
        const modal = document.querySelector("[data-modal]");
        const eventName = button.getAttribute("data-event-name");
        const eventPrice = button.getAttribute("data-event-price");
        const eventPicture = button.getAttribute("data-event-picture");

        const eventNameInput = document.querySelector(".eventName");
        const priceInput = document.querySelector(".price");
        const pictureInput = document.querySelector(".picture");
        const eventPictureElement = document.querySelector(".eventPicture");

        document.querySelector(".eventName").value = eventName;
        document.querySelector(".price").value = eventPrice;

        eventNameInput.value = eventName;
        priceInput.value = eventPrice;
        pictureInput.value = eventPicture;
        eventPictureElement.src = `./images/${eventPicture}`;

        document.getElementById("itemNameSpan").textContent = `Your buying ${eventName}`;
        document.getElementById("amountSpan").textContent = `Amount is ₱${eventPrice}`;

        modal.showModal();
    });
});
document.addEventListener("DOMContentLoaded", function () {
    const openButtons = document.querySelectorAll("[data-open-modal]");
    const modal = document.querySelector("[data-modal]");
    modal.addEventListener("click", (e) => {
        const dialogDimensions = modal.getBoundingClientRect();
        if (
            e.clientX < dialogDimensions.left ||
            e.clientX > dialogDimensions.right ||
            e.clientY < dialogDimensions.top ||
            e.clientY > dialogDimensions.bottom
        ) {
            modal.close();
        }
    }); 
});
*/

/*
const eventNameInput = document.querySelector(".eventName");
const priceInput = document.querySelector(".price");

const itemNameSpan = document.querySelector(".itemNameSpan");
const amountSpan = document.querySelector(".amountSpan");


const openButton = document.querySelector("[data-open-modal]");
const modal = document.querySelector("[data-modal]");
openButton.addEventListener("click", () => {
    eventNameInput.value = openButton.getAttribute("data-event-name");
    priceInput.value = openButton.getAttribute("data-event-price");
    
    itemNameSpan.innerText = `Your buying ${eventNameInput.value}`;
    amountSpan.innerText = `Amount is $${priceInput.value}`;
 
    modal.showModal();
});
modal.addEventListener("click", (e) => { 
    const dialogDimensions = modal.getBoundingClientRect();
    if (
        e.clientX < dialogDimensions.left ||
        e.clientX > dialogDimensions.right ||
        e.clientY < dialogDimensions.top ||
        e.clientY > dialogDimensions.bottom
    ) {
        modal.close();
    }
});
*/
/*
modal.addEventListener("click", (e) => {
    const dialog = modal.querySelector("dialog");
    const dialogRect = dialog.getBoundingClientRect();

    if (
        e.clientX < dialogRect.left ||
        e.clientX > dialogRect.right ||
        e.clientY < dialogRect.top ||
        e.clientY > dialogRect.bottom
    ) {
        modal.close();
    }
})  
*/  