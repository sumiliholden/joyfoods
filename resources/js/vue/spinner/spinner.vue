<template>
  <div class="spinner">
    <div class="content">
      <img src="/teemo.gif" alt="Page Loading..." />
      <div class="message">Please wait...</div>
    </div>
  </div>
</template>

<style>
.modal-dialog {
  overflow: hidden !important;
}

.spinner {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 200;
  overflow: hidden;
  background: rgba(0, 0, 0, 0.5);
}

.spinner > .content {
  position: relative;
  top: 40%;
  left: 50%;
}

.spinner > .content > img {
  height: 50px;
}

.spinner > .content > .message {
  color: #deb887;
}
</style>