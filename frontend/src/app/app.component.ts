import { Component } from '@angular/core';
import {ClickMode, Container, Engine, HoverMode, MoveDirection, OutMode} from "tsparticles-engine";
import {IParticlesProps} from "ng-particles";
import { loadFull } from "tsparticles";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.less']
})
export class AppComponent {
  id = "tsparticles";

  particlesOptions: IParticlesProps = {
    background: {
      color: {
        value: "none"
      }
    },
    fpsLimit: 120,
    interactivity: {
      events: {
        onClick: {
          enable: false,
          mode: ClickMode.push
        },
        onHover: {
          enable: true,
          mode: HoverMode.repulse
        },
        resize: true
      },
      modes: {
        push: {
          quantity: 4
        },
        repulse: {
          distance: 150,
          duration: 0.1
        }
      }
    },
    particles: {
      color: {
        value: "#ffffff"
      },
      links: {
        color: "#ffffff",
        distance: 150,
        enable: true,
        opacity: 0.5,
        width: 1
      },
      collisions: {
        enable: true
      },
      move: {
        direction: MoveDirection.none,
        enable: true,
        outModes: {
          default: OutMode.bounce
        },
        random: true,
        speed: 3,
        straight: false
      },
      number: {
        density: {
          enable: true,
          area: 1400
        },
        value: 80
      },
      opacity: {
        value: 0.5
      },
      shape: {
        type: "polygon"
      },
      size: {
        value: {min: 1, max: 5 },
      }
    },
    detectRetina: true
  };

  async particlesInit(engine: Engine): Promise<void> {
    await loadFull(engine);
  }
}
