<template>
  <div id="app">
    <v-app id="inspire" dark>
      <v-navigation-drawer clipped fixed v-model="drawer" app>
        <barofcom></barofcom>
      </v-navigation-drawer>

      <navbar :user="user"></navbar>

      <v-content>
        <v-container fluid fill-height>
          <v-layout justify-center>
            <v-flex shrink>
              <router-view></router-view>
            </v-flex>
          </v-layout>
        </v-container>
      </v-content>
      <v-footer app fixed>
        <span>&copy; 2019</span>
      </v-footer>
    </v-app>
  </div>
</template>

<script>
import Barofcom from "./_barofcom";
import Navbar from "./_navbar";

export default {
  components: { Barofcom, Navbar },
  data: () => ({
    drawer: null
  }),
  props: ["user"]
};
</script>