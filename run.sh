#!/bin/bash
tmux new-session -d -s gardensensor "python sensor.py & python logger.py"