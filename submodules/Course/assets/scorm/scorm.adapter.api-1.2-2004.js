let scormAPI = {
  version: '1.2',

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

  init (version, options) {
    this.setOptions(options);
    this.setVersion(version);

    this.misc.debug(true, "init(options)", 'setOptions() was called');

    this.Cache().init();
    this.Error().init();
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
    this.status = 'not attempted';
    this.options = Object.assign({
      GET: '',
      POST: '',
      _token: '',
      debug: false,
      timeout: 800,
      version: '1.2',
    }, options);
  },

  BeforeInitialize (dummyString) {
    this.misc.debug(true, "BeforeInitialize('')", 'is running.');

    let event = new CustomEvent('BeforeInitialize', { detail: {varname: dummyString, cache: JSON.parse(JSON.stringify(this.Cache().get()))} });

    this.misc.debug(true, "BeforeInitialize Event", 'was created.');

    this.misc.debug(true, "BeforeInitialize Event", 'will be dispatched.');

    window.dispatchEvent(event);
  },

  LMSInitialize (dummyString) {
    this.misc.debug(true, "LMSInitialize", 'initializing...');

    let self = this;

    let event = new CustomEvent('LMSInitialize', { detail: {cache: this.Cache().get()} });
    window.dispatchEvent(event);

    self.misc.style();

    self.flags().set('initialized', true);
    console.warn('------------------------------', self.flags);

    return "true";
  },

  LMSGetValue (varname) {
    if (! this.flags().get('initialized') || this.flags().get('finished')) {
      this.Error().set('301');
      return '';
    }

    let event = new CustomEvent('LMSGetValue', { detail: {varname, value: this.Cache().get(varname), cache: this.Cache().get()} });
    let e = window.dispatchEvent(event);

    this.misc.debug(true, "LMSGetValue", 'getting...', varname, "Result:", JSON.parse(JSON.stringify(this.Cache().get(varname))));

    return this.Cache().get(varname);
  },

  LMSSetValue (varname, value) {
    this.misc.debug(true, "LMSSetValue", 'setting...', varname, 'with', value);

    let event = new CustomEvent('LMSSetValue', { detail: {varname, value, cache: this.cache} });
    window.dispatchEvent(event);

    // Sometimes the SCORM Package does not call
    // the LMSCommit (fucking course developers)
    // so we try and commit every time we receive
    // `completed` as lesson_status
    // and we call it only once a page load.
    this.misc.debug(true, JSON.parse(JSON.stringify(this.Cache().get())));
    if (this.Cache().get('cmi.core.lesson_status') === 'completed' && this.status !== 'completed') {
      scormAPI.LMSCommit('');
      scormAPI.LMSFinish('');
      this.status = 'completed';
      this.misc.debug(true, "LMSSetValue", '------------------------------------');
      this.misc.debug(true, "LMSSetValue", 'LMSCommit() called from LMSSetValue', 'status:', this.status);
      this.misc.debug(true, "LMSSetValue", '------------------------------------');
    }

    return this.Cache().set(varname, value);
  },

  LMSCommit (dummyString) {
    let query = "?";
    for (varname in this.Cache().get()) {
      query += varname + "=" + this.Cache().get(varname) + "&";
    }

    let event = new CustomEvent('LMSCommit', { detail: {dummyString: dummyString, value: this.Cache().get(), cache: query} });
    window.dispatchEvent(event);

    this.misc.debug(true, "[LMSCommit]", "-----------");
    this.misc.debug(true, "[LMSCommit]", "was called.");
    this.misc.debug(true, "[LMSCommit]", "-----------");

    return "true";
  },

  LMSFinish (dummyString) {
    if (this.flags().get('finished')) {
      // already finished - prevent repeat call
      this.misc.debug(true, "[LMSFinish]", "-----------");
      this.misc.debug(true, "[LMSFinish]", "LMSFinish.done was flagged: ", this.flags().get('finished'));
      this.misc.debug(true, "[LMSFinish]", "Will prematurely exit.");
      this.misc.debug(true, "[LMSFinish]", "-----------");

      return "true";
    }

    // Commit values
    scormAPI.LMSCommit(''); // commit the cached values to database.
    let event2 = new CustomEvent('CourseEnded', { detail: {dummyString: dummyString} });
    window.dispatchEvent(event2);

    let event = new CustomEvent('LMSFinish', { detail: {dummyString: dummyString} });
    window.dispatchEvent(event);
    // It's done.
    this.flags().set('finished', true);
    this.misc.debug(true, "[LMSFinish]", "-----------");
    this.misc.debug(true, "[LMSFinish]", "LMSFinish.done was flagged: ", this.flags().get('finished'));
    this.misc.debug(true, "[LMSFinish]", "True exit.");
    this.misc.debug(true, "[LMSFinish]", "-----------");

    return "true";
  },

  /**
   * SCORM RTE Functions / Error Handling
   */
  LMSGetLastError () {
    return 0;
  },

  LMSGetDiagnostic (errorCode) {
    return "something string";
  },

  LMSGetErrorString (errorCode) {
    return "error string";
  },
  // Error Cache
  Error () {
    let self = this;

    return {
      init () {
        /**
         * The current Error Code.
         * @type {String}
         */
        self.currentErrorCode = '0';

        /**
         * Error Codes can be found here.
         * https://scorm.com/scorm-explained/technical-scorm/run-time/run-time-reference/
         * @type {Object}
         */
        self.errorMessages = new Object();
        self.errorMessages = {
          '0'  : 'No Error',
          '101': 'General Exception',
          '201': 'Invalid Argument',
          '202': 'Element Cannot Have Children',
          '203': 'Element Not an Array - Cannot Have Children',
          '301': 'API Not Initialized',
          '401': 'Undefined Data Model Element',
          '402': 'Invalid Set Value - Element is a Keyword',
          '403': 'Invalid Set Value - Element is Read Only',
          '404': 'Invalid Get Value - Element is Write Only',
          '405': 'Invalid Set Value - Incorrect Data Type',
        }
      },

      set (value) {
        self.currentErrorCode = value;
      },

      get () {
        return self.currentErrorCode;
      }
    }
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

  flags () {
    let self = this;

    return {
      initialized: false,
      finished: false,

      set (key, value) {
        self.flags[key] = value;
      },

      get (key) {
        return self.flags[key];
      },
    };
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

      scormAPI.misc.debug(true, "misc.style()", interactive, interactive.offsetWidth, interactive.offsetHeight);
    },

    debug (timestampped, ...args) {
      if (scormAPI.options && scormAPI.options.debug) {
        let d = new Date();
        let H = scormAPI.misc.pad(d.getHours());
        let i = scormAPI.misc.pad(d.getMinutes());
        let s = scormAPI.misc.pad(d.getSeconds());
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
      scormAPI.misc.debug("You went fullscreen");
      el.classList.toggle('interactive-container--landscape');

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
        screen.orientation && screen.orientation.lock('landscape');
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
        // screen.orientation && screen.orientation.lock('portrait');
      }

    },
  },

  // Version
  setVersion (version) {
    this.version = version;
    this.options.version = version;
    this.misc.debug(true, "[VERSION]", "------------------------------------- setting version...");

    switch (this.version) {
      case "1484_11":
      case "2004":
      case "2004 3rd Edition":
        window.API_1484_11 = this;
        window.API_1484_11.Initialize = scormAPI.LMSInitialize;
        window.API_1484_11.GetValue = scormAPI.LMSGetValue;
        window.API_1484_11.SetValue = scormAPI.LMSSetValue;
        window.API_1484_11.Commit = scormAPI.LMSCommit;
        window.API_1484_11.Terminate = scormAPI.LMSFinish;
        window.API_1484_11.GetLastError = scormAPI.LMSGetLastError;
        window.API_1484_11.GetErrorString = scormAPI.LMSGetErrorString;
        window.API_1484_11.GetDiagnostic = scormAPI.LMSGetDiagnostic;
        window.API = window.API_1484_11;
        this.misc.debug(true, "The [SCORM] version is:", this.version, window.API_1484_11);
        break;

      case "1.2":
      default:
        window.API = this;
        this.misc.debug(true, "The [SCORM] version is:", this.version, window.API);
        break;
    }
    this.misc.debug(true, "[VERSION]", "------------------------------------- version set.");
    // Alias
  },
}

window.API = window.API_1484_11 || scormAPI;
window.onunload = scormAPI.LMSFinish('');
window.onbeforeunload = scormAPI.LMSFinish('');
