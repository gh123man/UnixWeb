#!/bin/bash
tail -f /var/log/apache2/error.log | sed 's/\\n/\n/g'
