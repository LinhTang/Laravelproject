<template>
  <div class="row">
    <div class="col-sm-12">
      <h2>Please choose your food:</h2>
      <div class="information">
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th></th>
              <th>name</th>
              <th>price</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="i in foodItem" :key="i">
              <td>
                <label class="form-checkbox">
                  <input type="radio" :value="i.name" v-model="checked" />
                  <i class="form-icon"></i>
                </label>
              </td>
              <td>{{i.name}}</td>
              <td>{{i.price}}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <div class="user">
      <hr class="style2" />
      <h2>Information of order</h2>
      <form style="margin-left: 100px">
        <div class="col-sm-8 col-sm-offset-2 col-xs-12 col-md-6 col-md-offset-3 form-group">
          <label>Branch</label>
          <div
            type="text"
            id="branch"
            class="form-control"
            rows="3"
            style="height:50px; font-size: 20px; overflow-y: scroll;"
          >{{user.name}}</div>
        </div>
        <div class="col-sm-8 col-sm-offset-2 col-xs-12 col-md-6 col-md-offset-3 form-group">
          <label>Name</label>
          <input type="text" id="name" class="form-control" rows="3" v-model="username" value="1" />
        </div>
        <div class="col-sm-8 col-sm-offset-2 col-xs-12 col-md-6 col-md-offset-3 form-group">
          <label>You selected</label>
          <div
            type="text"
            id="checked"
            class="form-control"
            rows="3"
            style="height:50px; font-size: 20px; overflow-y: scroll;"
          >{{checked}}</div>
        </div>
        <div class="col-sm-8 col-sm-offset-2 col-xs-12 col-md-6 col-md-offset-3 form-group">
          <label>Time</label>
          <div
            type="text"
            id="time"
            class="form-control"
            rows="3"
            style="font-size: 20px; "
          >{{timeorder}}</div>
        </div>
        <div class="col-sm-8 col-sm-offset-2 col-xs-12 col-md-6 col-md-offset-3 form-group">
          <label>Message</label>
          <input type="text" id="message" class="form-control" rows="3" v-model="mess" />
        </div>
        <div class="col-sm-8 col-sm-offset-2 col-xs-12 col-md-6 col-md-offset-3 form-group">
          <button
            class="btn btn-secondary"
            :checked="checked"
            @click.prevent="submit"
            style="font-size: 20px"
          >Submit</button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
export default {
  name: "Order",
  components: {},
  methods: {},
  props: ["user"],
  data() {
    return {
      foodItem: "",
      errors: [],
      checked: "",
      checkedAll: false,
      mess: "",
      username: "",
      orderlist: []
    };
  },
  computed: {
    timeorder: function() {
      var today = new Date().toLocaleDateString();

      return today;
    }
  },
  mounted() {
    axios
      .get("http://localhost:3000/Menu")
      .then(response => {
        this.foodItem = response.data;
        console.log(response.data);
        console.log(this.foodItem);
      })
      .catch(e => {
        this.errors.push(e);
      });
  },
  methods: {
    submit() {
      const orderinfo = {
        username: this.username,
        mess: this.mess,
        checked: this.checked,
        time: this.timeorder
      };
      //console.log(orderinfo);
      axios
        .post("http://localhost:3000/order", orderinfo)
        .then(response => {})
        .catch(e => {
          this.errors.push(e);
        });
      this.username = "";
      this.mess = "";
      this.checked = "";
    },
    check() {
      this.checked = [];
      if (!this.checkedAll) {
        for (let i in this.foodItem) {
          this.checked.push(this.foodItem[i].name);
        }
      }
    }
  }
};
</script>
<style scoped>
.row {
  min-height: 1000px;
}
h3 {
  font-size: 40px;
  margin: 0 0 0 500px;
  padding: 10px;
}
h2 {
  font-size: 30px;
  margin: 0 0 0 60px;
  padding: 20px;
}
.information {
  font-size: 20px;
  line-height: 35px;
  width: 1000px;
  height: 700px;
  overflow-y: scroll;
  padding: 20px;
  margin: 0 0 10px 100px;
}
.style2 {
  height: 10px;
  border: 0;
  box-shadow: 0 10px 10px -10px #8c8b8b inset;
}
.style1 {
  height: 30px;
  border-style: solid;
  border-color: #8c8b8b;
  border-width: 1px 0 0 0;
  border-radius: 20px;
}
.user {
  margin: auto;
  margin-top: 100px;
  padding: 10px;
  font-size: 20px;
  width: 100%;
}
input[type="text"],
select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  font-size: 20px;
}
</style>
