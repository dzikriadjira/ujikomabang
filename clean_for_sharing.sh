#!/bin/bash

echo "🧹 Cleaning project for sharing..."

# Remove large directories that can be reinstalled
echo "Removing node_modules..."
rm -rf node_modules/

echo "Removing vendor..."
rm -rf vendor/

# Remove cache and log files
echo "Clearing cache and logs..."
rm -rf storage/logs/*
rm -rf storage/framework/cache/*
rm -rf storage/framework/sessions/*
rm -rf storage/framework/views/*

# Remove git history (optional)
echo "Removing .git directory..."
rm -rf .git/

# Remove any temporary files
echo "Removing temporary files..."
find . -name "*.tmp" -delete
find . -name "*.log" -delete
find . -name ".DS_Store" -delete

echo "✅ Project cleaned successfully!"
echo ""
echo "📦 Now you can zip the project:"
echo "zip -r smkn4_bogor_project.zip . -x '*.zip' 'clean_for_sharing.sh'"
echo ""
echo "📋 Don't forget to include:"
echo "- SETUP_INSTRUCTIONS.md"
echo "- .env.example"
echo "- All source code files"
