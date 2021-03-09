const incoming = document.querySelector("#incoming"),
  outgoing = document.querySelector("#outgoing"),
  message = document.querySelector("#message"),
  sendBtn = document.querySelector("#send_btn"),
  form = document.querySelector("form"),
  chatbox = document.querySelector(".chat-box");

const sendMessage = () => {
  const data = new FormData();
  data.append("message", message.value);
  data.append("incoming", incoming.value);
  data.append("outgoing", outgoing.value);

  fetch("php/insert-message.php", {
    method: "POST",
    header: {
      "Content-Type": "x-www-form-urlencoded",
    },
    body: data,
  })
    .then((res) => res.text())
    .then((data) => {
      if (data === "success") {
        message.value = "";
        scrollToBottom();
      }
    });
};

const recieveMessages = () => {
  const data = new FormData();
  data.append("incoming", incoming.value);
  data.append("outgoing", outgoing.value);

  fetch("php/get-messages.php", {
    method: "POST",
    header: {
      "Content-Type": "x-www-form-urlencoded",
    },
    body: data,
  })
    .then((res) => res.text())
    .then((data) => {
      chatbox.innerHTML = data;
      if (!chatbox.classList.contains("active")) {
        scrollToBottom();
      }
    });
};

const scrollToBottom = () => {
  chatbox.scrollTop = chatbox.scrollHeight;
};

setInterval(recieveMessages, 500);

chatbox.addEventListener("mouseenter", (e) => {
  chatbox.classList.add("active");
});
chatbox.addEventListener("mouseleave", (e) =>
  chatbox.classList.remove("active")
);

sendBtn.addEventListener("click", sendMessage);
form.addEventListener("submit", (e) => e.preventDefault());
