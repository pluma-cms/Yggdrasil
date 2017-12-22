window.API_1484_11 = {
  on (events, callback) {
    let self = this;

    events.split(',').forEach(event => {
      event = event.trim();
      window.addEventListener(event, function (e) {
        let firstParam = (typeof e.detail.varname === "undefined") ? e.detail.cache : e.detail.varname;
        let secondParam = (typeof e.detail.value === "undefined") ? e.detail.cache : e.detail.value;
        let cache = (typeof e.detail.cache === "undefined") ? e : e.detail.cache;
        callback(firstParam, secondParam, cache);
      });
    })
  },

  init (options) {
    this.setOptions(options);
    this.misc.debug(true, "init(options)", 'setOptions() was called');

    this.Cache().init();
    this.misc.debug(true, "init(options)", 'Cache().init() was called');

    this.BeforeInitialize('');
    this.misc.debug(true, "init(options)", 'BeforeInitialize() was called');

    this.initVideo();
    this.misc.debug(true, "init(options)", 'initVideo() was called');

    return this;
  },

  initVideo () {
    let self = this;
    let buttons = document.querySelectorAll('button');
    buttons.forEach(button => {
      button.onclick = function (e) {
        setTimeout(function () {
          let video = document.querySelector('video.interactive-content');
          self.misc.debug(true, "initVideo()", 'the querySelector found:', video);
          if (video) {
            video.onended = function (e) {
              let event = new CustomEvent('VideoEnded', { detail: {varname: video, value: e } });
              window.dispatchEvent(event);
            };
          }
        }, 900);
      }
    })
  },

  setOptions(options) {
    this.done = false;
    this.status = 'not-attempted';

    this.options = Object.assign({
      GET: '',
      POST: '',
      _token: '',
      debug: false,
      timeout: 800,
    }, options);
  },

  BeforeInitialize (dummyString) {
    this.misc.debug(true, "BeforeInitialize('')", 'is running.');

    let event = new CustomEvent('BeforeInitialize', { detail: {varname: dummyString, cache: JSON.parse(JSON.stringify(this.Cache().get()))} });

    this.misc.debug(true, "BeforeInitialize Event", 'was created.');

    this.misc.debug(true, "BeforeInitialize Event", 'will be dispatched.');

    window.dispatchEvent(event);
  },

  Initialize (dummyString) {
    this.misc.debug(true, "Initialize", 'initializing...');

    let self = this;

    let event = new CustomEvent('Initialize', { detail: {cache: this.Cache().get()} });
    window.dispatchEvent(event);

    self.misc.style();

    return "true";
  },

  GetValue (varname) {
    let event = new CustomEvent('GetValue', { detail: {varname, value: this.Cache().get(varname), cache: this.Cache().get()} });
    let e = window.dispatchEvent(event);

    this.misc.debug(true, "GetValue", 'getting...', varname, "Result:", JSON.parse(JSON.stringify(this.Cache().get(varname))));

    return this.Cache().get(varname);
  },

  SetValue (varname, value) {
    this.misc.debug(true, "SetValue", 'setting...', varname, 'with', value);

    let event = new CustomEvent('SetValue', { detail: {varname, value, cache: this.cache} });
    window.dispatchEvent(event);

    // Sometimes the SCORM Package does not call
    // the Commit (fucking course developers)
    // so we try and commit every time we receive
    // `completed` as lesson_status
    // and we call it only once a page load.
    this.misc.debug(true, JSON.parse(JSON.stringify(this.Cache().get())));
    if (this.Cache().get('cmi.core.lesson_status') === 'completed' && this.status !== 'completed') {
      window.API_1484_11.Commit('');
      window.API_1484_11.Terminate('');
      this.status = 'completed';
      this.misc.debug(true, "SetValue", '------------------------------------');
      this.misc.debug(true, "SetValue", 'Commit() called from SetValue', 'status:', this.status);
      this.misc.debug(true, "SetValue", '------------------------------------');
    }

    return this.Cache().set(varname, value);
  },

  Commit (dummyString) {
    let query = "?";
    for (varname in this.Cache().get()) {
      query += varname + "=" + this.Cache().get(varname) + "&";
    }

    let event = new CustomEvent('Commit', { detail: {dummyString: dummyString, value: this.Cache().get(), cache: query} });
    window.dispatchEvent(event);

    this.misc.debug(true, "[Commit]", "-----------");
    this.misc.debug(true, "[Commit]", "was called.");
    this.misc.debug(true, "[Commit]", "-----------");

    return "true";
  },

  Terminate (dummyString) {
    if (this.done) {
      // already finished - prevent repeat call
      this.misc.debug(true, "[Terminate]", "-----------");
      this.misc.debug(true, "[Terminate]", "Terminate.done was flagged: ", this.done);
      this.misc.debug(true, "[Terminate]", "Will prematurely exit.");
      this.misc.debug(true, "[Terminate]", "-----------");

      return "true";
    }

    // Commit values
    window.API_1484_11.Commit(''); // commit the cached values to database.
    let event2 = new CustomEvent('CourseEnded', { detail: {dummyString: dummyString} });
    window.dispatchEvent(event2);

    let event = new CustomEvent('Terminate', { detail: {dummyString: dummyString} });
    window.dispatchEvent(event);
    // It's done.
    this.done = true;
    this.misc.debug(true, "[Terminate]", "-----------");
    this.misc.debug(true, "[Terminate]", "Terminate.done was flagged: ", this.done);
    this.misc.debug(true, "[Terminate]", "True exit.");
    this.misc.debug(true, "[Terminate]", "-----------");

    return "true";
  },

  /**
   * SCORM RTE Functions / Error Handling
   */
  GetLastError () {
    return 0;
  },

  GetErrorString (errorCode) {
    return "error string";
  },

  GetDiagnostic (errorCode) {
    return "something string";
  },

  // Cache
  Cache () {
    let self = this;

    return {
      init () {
        self.cache = new Object();
        self.cache['_token'] = self.options._token;
        self.cache['adlcp:masteryscore'] = '';
        self.cache['cmi.core._children'] = '';
        self.cache['cmi.core.credit'] = '';
        self.cache['cmi.core.entry'] = '';
        self.cache['cmi.core.exit'] = '';
        self.cache['cmi.core.lesson_location'] = '';
        self.cache['cmi.core.lesson_mode'] = '';
        self.cache['cmi.core.lesson_status'] = '';
        self.cache['cmi.core.score._children'] = '';
        self.cache['cmi.core.score.raw'] = '';
        self.cache['cmi.core.session_time'] = '';
        self.cache['cmi.core.student_id'] = '';
        self.cache['cmi.core.student_name'] = '';
        self.cache['cmi.core.total_time'] = '';
        self.cache['cmi.launch_data'] = '';
        self.cache['cmi.suspend_data'] = '';
        self.cache['cmi.comments'] = '';

        self.misc.debug(true, "Cache.init()", JSON.parse(JSON.stringify(self.cache)));
        self.misc.debug(false, "");

        return this;
      },

      get (varname) {
        if (typeof varname === "undefined" || varname === "") return self.cache;

        self.misc.debug(true, "Cache.get([varname])", varname, self.cache[varname]);
        self.misc.debug(false, "");
        // debugger;

        return typeof self.cache[varname] === "undefined" ? "" : self.cache[varname];
      },

      set (varname, value) {
        self.cache[varname] = value;

        self.misc.debug(true, "Cache.set(varname, value)", varname, 'with', value, "Result: ", self.cache[varname]);
        self.misc.debug(false, "");

        return "true";
      },

      setMultiple (array) {
        for (var i = array.length - 1; i >= 0; i--) {
          let current = array[i];
          self.cache[current.name] = current.val ? current.val : "";
        }

        self.status = self.cache['cmi.core.lesson_status'];

        self.misc.debug(true, "Cache.setMultiple(array)", JSON.parse(JSON.stringify(self.cache)), 'lesson_status', self.status);
        self.misc.debug(false, "");
      },
    }
  },

  misc: {
    style () {
      let body = document.getElementsByTagName("body")[0];
      body.classList.add("lms", "lms-fullscreen");

      let interactive = document.querySelector('.interactive-content');
      // let interactiveContent = interactive.contentDocument.body || interactive.contentWindow.body;

      if (interactive) {
        var height = interactive.offsetWidth*9/16; // 16:9 aspect ratio
        interactive.setAttribute('height', height+'px');
      }

      window.onresize = function (e) {
        if (interactive) {
          var height = interactive.offsetWidth*9/16; // 16:9 aspect ratio
          interactive.setAttribute('height', height+'px');
        }
      }

      window.API_1484_11.misc.debug(true, "misc.style()", interactive, interactive.offsetWidth, interactive.offsetHeight);
    },

    debug (timestampped, ...args) {
      if (window.API_1484_11.options && window.API_1484_11.options.debug) {
        let d = new Date();
        let H = window.API_1484_11.misc.pad(d.getHours());
        let i = window.API_1484_11.misc.pad(d.getMinutes());
        let s = window.API_1484_11.misc.pad(d.getSeconds());
        let timestamp = [H, i, s].join(":");

        if (timestampped) {
          console.log("[SCORMAPI]"+"["+timestamp+"]", ...args);
        } else {
          console.log(...args);
        }
      }
    },

    pad (num, size) {
      let s = num.toString();
      while (s.length < (size || 2)) { s = "0" + s; }
      return s;
    },
  },

  stage: {
    fullscreen (el) {
      el = el || document.documentElement;
      window.API_1484_11.misc.debug("You went fullscreen");

      if (!document.fullscreenElement && !document.mozFullScreenElement &&
        !document.webkitFullscreenElement && !document.msFullscreenElement) {
        if (el.requestFullscreen) {
          el.requestFullscreen();
        } else if (el.msRequestFullscreen) {
          el.msRequestFullscreen();
        } else if (el.mozRequestFullScreen) {
          el.mozRequestFullScreen();
        } else if (el.webkitRequestFullscreen) {
          el.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
        }
      } else {
        if (document.exitFullscreen) {
          document.exitFullscreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        } else if (document.mozCancelFullScreen) {
          document.mozCancelFullScreen();
        } else if (document.webkitExitFullscreen) {
          document.webkitExitFullscreen();
        }
      }

      if (screen.orientation && screen.orientation.lock('landscape')) {
        // alert('clocked');
      }
    },
  }
}

window.onunload = window.API_1484_11.Terminate('');
window.onbeforeunload = window.API_1484_11.Terminate('');
