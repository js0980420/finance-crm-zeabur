import { exec } from 'child_process';
import { promisify } from 'util';

const execAsync = promisify(exec);

const port = process.argv[2];

if (!port) {
  console.log('Usage: node kill-port.js <port>');
  process.exit(1);
}

async function killPort(port) {
  try {
    console.log(`Checking for processes on port ${port}...`);

    // Windows command to find and kill process on port
    const { stdout } = await execAsync(`netstat -ano | findstr :${port}`);

    if (stdout) {
      // Extract PIDs from netstat output
      const lines = stdout.trim().split('\n');
      const pids = new Set();

      for (const line of lines) {
        const parts = line.trim().split(/\s+/);
        const pid = parts[parts.length - 1];
        if (pid && pid !== '0') {
          pids.add(pid);
        }
      }

      // Kill each unique PID
      for (const pid of pids) {
        try {
          await execAsync(`taskkill /F /PID ${pid}`);
          console.log(`Killed process ${pid} on port ${port}`);
        } catch (err) {
          // Process might already be dead
          console.log(`Process ${pid} already terminated`);
        }
      }
    } else {
      console.log(`Port ${port} is free`);
    }
  } catch (error) {
    // No process found on port (expected when port is free)
    if (error.code === 1) {
      console.log(`Port ${port} is free`);
    } else {
      console.error(`Error checking port ${port}:`, error.message);
    }
  }
}

killPort(port);
