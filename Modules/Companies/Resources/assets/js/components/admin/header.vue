<template>
  <div>
    <nav
      class="navbar navbar-top navbar-expand navbar-light bg-secondary border-bottom"
    >
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav align-items-center ml-md-auto">
            <li class="nav-item d-xl-none">
              <!-- Sidenav toggler -->
              <div
                class="pr-3 sidenav-toggler sidenav-toggler-light"
                data-action="sidenav-pin"
                data-target="#sidenav-main"
              >
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </div>
            </li>
            <li class="nav-item d-sm-none">
              <a
                class="nav-link"
                href="#"
                data-action="search-show"
                data-target="#navbar-search-main"
              >
                <i class="ni ni-zoom-split-in"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                style="position: relative"
              >
                <i class="ni ni-bell-55"></i>
                <span
                  class="badge badge-md badge-circle badge-floating badge-danger border-white"
                  >{{ notifications.length }}</span
                >
              </a>
              <div
                class="dropdown-menu dropdown-menu-xl dropdown-menu-right py-0 overflow-hidden"
              >
                <!-- Dropdown header -->
                <div class="px-3 py-3">
                  <h6 class="text-sm text-muted m-0">
                    You have
                    <strong class="text-primary">{{
                      notifications.length
                    }}</strong>
                    notifications.
                  </h6>
                </div>
                <!-- List group -->
                <div class="list-group list-group-flush" id="notify">
                  <a
                    v-for="item in notifications"
                    :key="item.id"
                    href="#!"
                    class="list-group-item list-group-item-action"
                  >
                    <button
                      type="button"
                      class="close"
                      v-on:click="deleteNotification(item)"
                      data-dismiss="alert"
                      aria-label="Close"
                    >
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="row align-items-center">
                      <div class="col ml--2">
                        <div
                          class="d-flex justify-content-between align-items-center"
                        >
                          <div>
                            <h4 class="mb-0 text-sm">{{ item.data.name }}</h4>
                          </div>
                        </div>
                        <p class="text-sm mb-0">
                          {{ item.data.description }}
                        </p>
                      </div>
                    </div>
                  </a>
                </div>
                <!-- View all -->
                <!-- <a
                  href="#!"
                  class="dropdown-item text-center text-primary font-weight-bold py-3"
                  >View all</a
                > -->
              </div>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <i class="ni ni-ungroup"></i>
              </a>
              <!-- @include('layouts.admin.shortcuts') -->
            </li>
          </ul>
          <ul class="navbar-nav align-items-center ml-auto ml-md-0">
            <li class="nav-item dropdown">
              <a
                class="nav-link pr-0"
                href="#"
                role="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <div class="media align-items-center">
                  <span
                    class="avatar avatar-sm rounded-circle"
                    style="background-color: white"
                  >
                    <img
                      alt="Image placeholder"
                      v-bind:src="'./modules/generals/argonTemplate/img/theme/user.png'"
                    />
                  </span>
                  <div class="media-body ml-2 d-none d-lg-block">
                    <span class="mb-0 text-sm font-weight-bold">{{
                      user.name
                    }}</span>
                  </div>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <div class="dropdown-header noti-title">
                  <h6 class="text-overflow m-0">Bienvenido!</h6>
                </div>
                <a
                  v-bind:href="'/admin/employees/' + user.id + '/profile'"
                  class="dropdown-item"
                >
                  <i class="ni ni-single-02"></i>
                  <span>Mi perfil</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="/admin/logout" class="dropdown-item">
                  <i class="ni ni-user-run"></i>
                  <span>Salir</span>
                </a>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>
<style >
.badge-circle {
  position: absolute;
  top: -0.5vw;
  right: 0.3vw;
  font-size: 0.8vw;
  width: 1.4vw !important;
  height: 1.4vw !important;
}
</style>
<script>
export default {
  props: ["user"],
  data() {
    return {};
  },
  created() {
    this.$store.dispatch("getNotifications");
  },
  mounted() {
    window.Echo.channel("channel").listen("Test", (e) => {
      this.saveNotifications(e.message);
      this.newAlert(e);
    });
  },
  methods: {
    newAlert(data) {
      if (!Notification) {
        alert(
          "las notificaciones no se soportan en tu navegador, descarga una nueva version"
        );
      }
      if (Notification.permission !== "granted") {
        Notification.requestPermission();
      } else {
        new Notification("Notificación", {
          icon:
            "https://www.designbust.com/download/168/png/laravel_icon512.png",
          body: data.message.data,
          requireInteraction: true,
        });
      }
    },

    deleteNotification(data) {
      this.$store.dispatch("deleteNotification", data.id);
    },
    saveNotifications(data) {
      this.$store.dispatch("saveNotification", data);
    },
  },
  computed: {
    notifications() {
      return this.$store.state.notifications;
    },
  },
};
</script>
