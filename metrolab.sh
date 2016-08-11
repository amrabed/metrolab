ssh -L 3306:127.0.0.1:3306 -p 2200 amrabed@hc01.hume.vt.edu -N &
python3 metrolab.py 3600 &
