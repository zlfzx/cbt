<template>
  <v-app id="inspire">
    <v-content>
      <v-container
        class="fill-height blue"
        dark
        fluid
      >
        <v-row
          align="center"
          justify="center"
        >
          <v-col
            cols="12"
            sm="8"
            md="4"
            lg="3"
          >
            <v-card class="elevation-12 pa-5">
              <div align="center" justify="center">
                <v-img src="/assets/img/screen.png" width="100px" contain></v-img>
              </div>
              <h1 class="display-1 text-center grey--text">LOGIN CBT</h1>
              <v-card-text>
                <v-form>
                  <v-text-field
                    label="NIS"
                    name="login"
                    prepend-icon="mdi-account"
                    type="text"
                  />

                  <v-text-field
                    id="password"
                    label="Password"
                    name="password"
                    prepend-icon="mdi-lock"
                    type="password"
                  />
                </v-form>
              </v-card-text>
              <v-card-actions>
                <v-btn to="/" color="yellow" block rounded>Login</v-btn>
              </v-card-actions>
            </v-card>
          </v-col>
        </v-row>
      </v-container>
    </v-content>
  </v-app>
</template>
