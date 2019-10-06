<template>
  <div id="bar">
    <v-list dense>
      <v-list-item exact to="/admin/welcome">
        <v-list-item-action>
          <v-icon>home</v-icon>
        </v-list-item-action>
        <v-list-item-content id="t1">
          <v-list-item-title>Home</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item exact to="/admin/menu">
        <v-list-item-action>
          <v-icon>menu</v-icon>
        </v-list-item-action>
        <v-list-item-content id="t1">
          <v-list-item-title>Menu</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item exact to="/admin/users">
        <v-list-item-action>
          <v-icon>account_circle</v-icon>
        </v-list-item-action>
        <v-list-item-content id="t1">
          <v-list-item-title>User management</v-list-item-title>
        </v-list-item-content>
      </v-list-item>

      <v-list-item exact to="/admin/roles">
        <v-list-item-action>
          <v-icon>account_circle</v-icon>
        </v-list-item-action>
        <v-list-item-content id="t1">
          <v-list-item-title>Role management</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </div>
</template>


<script>
export default {};
</script>
<style scoped>
#bar {
  padding: 30px 0 0 0;
  font-size: 50px;
}
#t1 {
  height: 50px;
  margin: 5px;
}
</style>



